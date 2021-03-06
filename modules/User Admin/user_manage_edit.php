<?php
/*
Gibbon, Flexible & Open School System
Copyright (C) 2010, Ross Parker

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

use Gibbon\Forms\Form;
use Gibbon\Forms\DatabaseFormFactory;

//Module includes
require_once __DIR__ . '/moduleFunctions.php';

if (isActionAccessible($guid, $connection2, '/modules/User Admin/user_manage_edit.php') == false) {
    //Acess denied
    echo "<div class='error'>";
    echo __('You do not have access to this action.');
    echo '</div>';
} else {
    //Proceed!
    $roleList = getRoleList($_SESSION[$guid]['gibbonRoleIDCurrent'], $connection2); //GS//
    $myRole = $roleList[0][1]; //GS//

    if ($myRole != 'Teacher') {//GS//
      $page->breadcrumbs
           ->add(__('Manage Users'), 'user_manage.php')
           ->add(__('Edit User'));
    } //GS//

    $returns = array();
    $returns['warning1'] = __('Your request was completed successfully, but one or more images were the wrong size and so were not saved.');
    if (isset($_GET['return'])) {
        returnProcess($guid, $_GET['return'], null, $returns);
    }

    //Check if school year specified
    $gibbonPersonID = $_GET['gibbonPersonID'];
    if ($gibbonPersonID == '') {
        echo "<div class='error'>";
        echo __('You have not specified one or more required parameters.');
        echo '</div>';
    } else {
        try {
            $data = array('gibbonPersonID' => $gibbonPersonID);
            $sql = 'SELECT * FROM gibbonPerson WHERE gibbonPersonID=:gibbonPersonID';
            $result = $connection2->prepare($sql);
            $result->execute($data);
        } catch (PDOException $e) {
            echo "<div class='error'>".$e->getMessage().'</div>';
        }

        if ($result->rowCount() != 1) {
            echo "<div class='error'>";
            echo __('The specified record cannot be found.');
            echo '</div>';
        } else {
            //Let's go!
            $values = $result->fetch();

            //Get categories
            $staff = false;
            $student = false;
            $parent = false;
            $other = false;
            $roles = explode(',', $values['gibbonRoleIDAll']);
            foreach ($roles as $role) {
                $roleCategory = getRoleCategory($role, $connection2);
				$staff = $staff || ($roleCategory == 'Staff');
				$student = $student || ($roleCategory == 'Student');
				$parent = $parent || ($roleCategory == 'Parent');
				$other = $other || ($roleCategory == 'Other');
            }

            $search = (isset($_GET['search']))? $_GET['search'] : '';

            if (!empty($search)) {
                echo "<div class='linkTop'>";
                echo "<a href='".$_SESSION[$guid]['absoluteURL'].'/index.php?q=/modules/User Admin/user_manage.php&search='.$search."'>".__('Back to Search Results').'</a>';
                echo '</div>';
			}

			echo '<div class="warning">';
			echo __('Note that certain fields are hidden or revealed depending on the role categories (Staff, Student, Parent) that a user is assigned to. For example, parents do not get Emergency Contact fields, and students/staff do not get Employment fields.');
			echo '</div>';

			$form = Form::create('addUser', $_SESSION[$guid]['absoluteURL'].'/modules/'.$_SESSION[$guid]['module'].'/user_manage_editProcess.php?gibbonPersonID='.$gibbonPersonID.'&search='.$search);
			$form->setFactory(DatabaseFormFactory::create($pdo));

			$form->addHiddenValue('address', $_SESSION[$guid]['address']);
			$form->addHiddenValue('address', $_SESSION[$guid]['address']);

			// BASIC INFORMATION
			$form->addRow()->addHeading(__('Basic Information'));

			if ($student){ //GS//
				$form->addHiddenValue('title', ''); //GS//
			} //GS//
			else { //GS//
				$row = $form->addRow();
				$row->addLabel('title', __('Title'));
				$row->addSelectTitle('title');
			} //GS//

			$row = $form->addRow();
				$row->addLabel('preferredName', __('First Name'))->description(__('First name as shown in ID documents.'));
				$row->addTextField('preferredName')->required()->maxLength(60);

                        $row = $form->addRow();
				$row->addLabel('surname', __('Surname'))->description(__('Family name as shown in ID documents.'));
				$row->addTextField('surname')->maxLength(60); //GS//

			$row = $form->addHiddenValue('firstName', ''); //GS//

			$row = $form->addHiddenValue('officialName', ''); //GS//

			$row = $form->addHiddenValue('nameInCharacters', ''); //GS//

			$row = $form->addRow();
				$row->addLabel('gender', __('Gender'));
				$row->addSelectGender('gender')->required();

			$row = $form->addRow();
				$row->addLabel('dob', __('Date of Birth'));
				$row->addDate('dob');

			$row = $form->addRow();
				$row->addLabel('file1', __('User Photo'))
					->description(__('Displayed at 240px by 320px.'))
					->description(__('Accepts images up to 360px by 480px.'))
					->description(__('Accepts aspect ratio between 1:1.2 and 1:1.4.'));
				$row->addFileUpload('file1')
					->accepts('.jpg,.jpeg,.gif,.png')
					->setAttachment('attachment1', $_SESSION[$guid]['absoluteURL'], $values['image_240'])
					->setMaxUpload(false);

			// SYSTEM ACCESS
			$form->addRow()->addHeading(__('System Access'));

			$data = array();
			$sql = "SELECT gibbonRoleID, gibbonRoleID, name, restriction FROM gibbonRole ORDER BY name";
			$result = $pdo->executeQuery($data, $sql);

			// Get all roles
			$allRoles = ($result && $result->rowCount() > 0)? $result->fetchAll(\PDO::FETCH_GROUP|\PDO::FETCH_UNIQUE) : array();

			// Put together an array of this user's current roles
			$currentUserRoles = (is_array($_SESSION[$guid]['gibbonRoleIDAll'])) ? array_column($_SESSION[$guid]['gibbonRoleIDAll'], 0) : array();
			$currentUserRoles[] = $_SESSION[$guid]['gibbonRoleIDPrimary'];

			// Filter all roles based on role restrictions
			$availableRoles = array_reduce($allRoles, function ($carry, $item) use (&$currentUserRoles) {
				if ($item['restriction'] == 'Admin Only') {
					if (!in_array('001', $currentUserRoles)) {
						return $carry;
					}
				} elseif ($item['restriction'] == 'Same Role') {
					if (!in_array($item['gibbonRoleID'], $currentUserRoles) && !in_array('001', $currentUserRoles)) {
						return $carry;
					}
				}
				$carry[$item['gibbonRoleID']] = $item['name'];
				return $carry;
			}, array());

			// Get info on the user role being edited
			$roleRestriction = null;
			if (isset($allRoles[$values['gibbonRoleIDPrimary']])) {
				$roleDetails = $allRoles[$values['gibbonRoleIDPrimary']];
            	$roleRestriction = $roleDetails['restriction'];
			}

			// Display a readonly field if the current role cannot be changed
			if (/*GS*/$myRole == 'Teacher' || /*GS*/empty($roleRestriction) || ($roleRestriction == 'Admin Only' && !in_array('001', $currentUserRoles)) || ($roleRestriction == 'Same Role' && !in_array($values['gibbonRoleIDPrimary'], $currentUserRoles) && !in_array('001', $currentUserRoles)) ) {
				$row = $form->addRow();
				$row->addLabel('gibbonRoleIDPrimaryName', __('Primary Role'))->description(__('Controls what a user can do and see.'));
				$row->addTextField('gibbonRoleIDPrimaryName')->readOnly()->setValue($roleDetails['name']);
				$form->addHiddenValue('gibbonRoleIDPrimary', $values['gibbonRoleIDPrimary']);
			} else {
                $row = $form->addRow();
                $row->addLabel('gibbonRoleIDPrimary', __('Primary Role'))->description(__('Controls what a user can do and see.'));
                $row->addSelect('gibbonRoleIDPrimary')->fromArray($availableRoles)->required()->placeholder();
			}

			// Grab the selected roles, and break apart into selectable roles and restricted roles
			$selectedRoles = explode(',', $values['gibbonRoleIDAll']);
			$selectableRoles = array_intersect(array_keys($availableRoles), $selectedRoles);
			unset($values['gibbonRoleIDAll']);

			$restrictedRoles = array_diff($selectedRoles, $selectableRoles);
			$restrictedRoles = array_intersect_key($allRoles, array_flip($restrictedRoles));

      if ($myRole == 'Teacher') //GS//
        $form->addHiddenValue('gibbonRoleIDAll', $selectableRoles); //GS//
      else{ //GS//
        $row = $form->addRow();
  				$row->addLabel('gibbonRoleIDAll', __('All Roles'))->description(__('Controls what a user can do and see.'));
  				$row->addSelect('gibbonRoleIDAll')->fromArray($availableRoles)->selectMultiple()->selected($selectableRoles);
      } //GS//

			if (!empty($restrictedRoles)) {
				$restrictedRolesList = implode(', ', array_column($restrictedRoles, 'name'));

				$row = $form->addRow();
					$row->addLabel('gibbonRoleIDRestricted', __('Restricted Roles'));
					$row->addTextField('gibbonRoleIDRestricted')->readOnly()->setValue($restrictedRolesList)->setClass('standardWidth');
			}

      if ($myRole == 'Teacher') {//GS//
        $form->addHiddenValue('username', $values['username']); //GS//
        $form->addHiddenValue('status', 'Full'); //GS//
        $form->addHiddenValue('canLogin', 'N'); //GS//
      } else { //GS//
        $row = $form->addRow();
          $row->addLabel('username', __('Username'))->description(__('System login name.'));
          $row->addUsername('username')
              ->required()
              ->setValue($values['username']);

  			$row = $form->addRow();
  				$row->addLabel('status', __('Status'))->description(__('This determines visibility within the system.'));
  				$row->addSelectStatus('status')->required();

  			$row = $form->addRow();
  				$row->addLabel('canLogin', __('Can Login?'));
  				$row->addYesNo('canLogin')->required();
      } //GS//

			$row = $form->addHiddenValue('passwordForceReset', 'No'); //GS//

			// CONTACT INFORMATION
			$form->addRow()->addHeading(__('Contact Information'));

      if ($myRole == 'Teacher') $form->addHiddenValue('email',''); //GS//
      else { //GS//
			     $row = $form->addRow();
                $emailLabel = $row->addLabel('email', __('Email'));
                $email = $row->addEmail('email');
      } //GS//

			$uniqueEmailAddress = getSettingByScope($connection2, 'User Admin', 'uniqueEmailAddress');
			if ($uniqueEmailAddress == 'Y') {
				$email->uniqueField('./modules/User Admin/user_manage_emailAjax.php', array('gibbonPersonID' => $gibbonPersonID));
			}

			$row = $form->addHiddenValue('emailAlternate', ''); //GS//

			$row = $form->addRow();
			$row->addAlert(__('Address information for an individual only needs to be set under the following conditions:'), 'warning')
				->append('<ol>')
				->append('<li>'.__('If the user is not in a family.').'</li>')
				->append('<li>'.__('If the user\'s family does not have a home address set.').'</li>')
				->append('<li>'.__('If the user needs an address in addition to their family\'s home address.').'</li>')
				->append('</ol>');

			$addressSet = ($values['address1'] != '' or $values['address1District'] != '' or $values['address1Country'] != '' or $values['address2'] != '' or $values['address2District'] != '' or $values['address2Country'] != '')? 'Yes' : '';

			$row = $form->addRow();
				$row->addLabel('showAddresses', __('Enter Personal Address?'));
				$row->addCheckbox('showAddresses')->setValue('Yes')->checked($addressSet);

			$form->toggleVisibilityByClass('address')->onCheckbox('showAddresses')->when('Yes');

			$row = $form->addRow()->addClass('address');
				$row->addLabel('address1', __('Address 1'))->description(__('Unit, Building, Street'));
				$row->addTextArea('address1')->maxLength(255)->setRows(2);

			$row = $form->addRow()->addClass('address');
				$row->addLabel('address1District', __('Address 1 District'))->description(__('County, State, District'));
				$row->addTextFieldDistrict('address1District');

			$row = $form->addRow()->addClass('address');
				$row->addLabel('address1Country', __('Address 1 Country'));
				$row->addSelectCountry('address1Country');

		/*GS
			if ($values['address1'] != '') {
				try {
					$dataAddress = array('gibbonPersonID' => $values['gibbonPersonID'], 'addressMatch' => '%'.strtolower(preg_replace('/ /', '%', preg_replace('/,/', '%', $values['address1']))).'%');
					$sqlAddress = "SELECT gibbonPersonID, title, preferredName, surname, category FROM gibbonPerson JOIN gibbonRole ON (gibbonPerson.gibbonRoleIDPrimary=gibbonRole.gibbonRoleID) WHERE status='Full' AND address1 LIKE :addressMatch AND NOT gibbonPersonID=:gibbonPersonID ORDER BY surname, preferredName";
					$resultAddress = $connection2->prepare($sqlAddress);
					$resultAddress->execute($dataAddress);
				} catch (PDOException $e) {
					echo "<div class='error'>".$e->getMessage().'</div>';
				}

				if ($resultAddress->rowCount() > 0) {
					$addressCount = 0;

					$row = $form->addRow()->addClass('address  matchHighlight');
					$row->addLabel('matchAddress', __('Matching Address 1'))->description(__('These users have similar Address 1. Do you want to change them too?'));
					$table = $row->addTable()->setClass('standardWidth');

                    while ($rowAddress = $resultAddress->fetch()) {
                        $adressee = formatName($rowAddress['title'], $rowAddress['preferredName'], $rowAddress['surname'], $rowAddress['category']).' ('.$rowAddress['category'].')';

                        $row = $table->addRow()->addClass('address');
                        $row->addTextField($addressCount.'-matchAddressLabel')->readOnly()->setValue($adressee)->setClass('fullWidth');
                        $row->addCheckbox($addressCount.'-matchAddress')->setValue($rowAddress['gibbonPersonID']);

                        $addressCount++;
					}

					$form->addHiddenValue('matchAddressCount', $addressCount);
				}
			}

			$row = $form->addRow()->addClass('address');
				$row->addLabel('address2', __('Address 2'))->description(__('Unit, Building, Street'));
                $row->addTextArea('address2')->maxLength(255)->setRows(2);

			$row = $form->addRow()->addClass('address');
				$row->addLabel('address2District', __('Address 2 District'))->description(__('County, State, District'));
				$row->addTextFieldDistrict('address2District');

			$row = $form->addRow()->addClass('address');
				$row->addLabel('address2Country', __('Address 2 Country'));
				$row->addSelectCountry('address2Country');
    GS*/

		for ($i = 1; $i <= /*GS*/2/*GS*/; ++$i) { //GS//
			$row = $form->addRow();
			$row->addLabel('phone'.$i, __('Phone').' '.$i); //GS//
			$row->addTextField('phone'.$i); //GS//
		}

		$row = $form->addHiddenValue('website', ''); //GS//

			// SCHOOL INFORMATION
			$form->addRow()->addHeading(__('School Information'));

            if ($student) {
                $dayTypeOptions = getSettingByScope($connection2, 'User Admin', 'dayTypeOptions');
                if (!empty($dayTypeOptions)) {
                    $dayTypeText = getSettingByScope($connection2, 'User Admin', 'dayTypeText');
                    $row = $form->addRow();
                    $row->addLabel('dayType', __('Day Type'))->description($dayTypeText);
                    $row->addSelect('dayType')->fromString($dayTypeOptions)->placeholder();
                }
            }

            if ($student || $staff) {
                $sql = "SELECT DISTINCT lastSchool FROM gibbonPerson ORDER BY lastSchool";
                $result = $pdo->executeQuery(array(), $sql);
                $schools = ($result && $result->rowCount() > 0)? $result->fetchAll(\PDO::FETCH_COLUMN) : array();

                $row = $form->addRow();
                $row->addLabel('lastSchool', __('Last School'));
                $row->addTextField('lastSchool')->autocomplete($schools);
            }

			$row = $form->addRow();
				$row->addLabel('dateStart', __('Start Date'))->description(__("Users's first day at school."));
				$row->addDate('dateStart');

			$row = $form->addRow();
                $row->addLabel('dateEnd', __('End Date'))->description(__("Users's last day at school."));
                $row->addDate('dateEnd');

            if ($student) {
                $row = $form->addRow();
                	$row->addLabel('gibbonSchoolYearIDClassOf', __('Class Of'))->description(__('When is the student expected to graduate?'));
                	$row->addSelectSchoolYear('gibbonSchoolYearIDClassOf');
			}

			if ($student || $staff) {
                $sql = "SELECT DISTINCT nextSchool FROM gibbonPerson ORDER BY lastSchool";
                $result = $pdo->executeQuery(array(), $sql);
                $schools = ($result && $result->rowCount() > 0)? $result->fetchAll(\PDO::FETCH_COLUMN) : array();

                $row = $form->addRow();
                $row->addLabel('nextSchool', __('Next School'));
                $row->addTextField('nextSchool')->autocomplete($schools);

				$departureReasonsList = getSettingByScope($connection2, 'User Admin', 'departureReasons');

				$row = $form->addRow();
				$row->addLabel('departureReason', __('Departure Reason'));
				if (!empty($departureReasonsList)) {
					$row->addSelect('departureReason')->fromString($departureReasonsList)->placeholder();
				} else {
					$row->addTextField('departureReason')->maxLength(30);
				}
			}

			// BACKGROUND INFORMATION
			//GS//$form->addRow()->addHeading(__('Background Information'));

			$row = $form->addHiddenValue('languageFirst', ''); //GS//

			$row = $form->addHiddenValue('languageSecond', ''); //GS//

			$row = $form->addHiddenValue('languageThird', ''); //GS//

			$row = $form->addRow();
				$row->addLabel('countryOfBirth', __('Country of Birth'));
				$row->addSelectCountry('countryOfBirth');

			$row = $form->addHiddenValue('birthCertificateScan', ''); //GS//

			//GS//$ethnicities = getSettingByScope($connection2, 'User Admin', 'ethnicity');
			//GS//$row = $form->addRow();
			//GS//	$row->addLabel('ethnicity', __('Ethnicity'));
			//GS//	if (!empty($ethnicities)) {
			//GS//		$row->addSelect('ethnicity')->fromString($ethnicities)->placeholder();
			//GS//	} else {
			//GS//		$row->addTextField('ethnicity')->maxLength(255);
			//GS//	}

			$religions = getSettingByScope($connection2, 'User Admin', 'religions');
			$row = $form->addRow();
				$row->addLabel('religion', __('Religion'));
				if (!empty($religions)) {
					$row->addSelect('religion')->fromString($religions)->placeholder();
				} else {
					$row->addTextField('religion')->maxLength(30);
				}

			$nationalityList = getSettingByScope($connection2, 'User Admin', 'nationality');
			$row = $form->addHiddenValue('citizenship1', ''); //GS//

			$row = $form->addHiddenValue('citizenship1Passport', ''); //GS//

			$row = $form->addHiddenValue('citizenship1PassportScan', ''); //GS//

			$row = $form->addHiddenValue('citizenship2', ''); //GS//

			$row = $form->addHiddenValue('citizenship2Passport', ''); //GS//

			if (!empty($_SESSION[$guid]['country'])) {
				$nationalIDCardNumberLabel = $_SESSION[$guid]['country'].' '.__('ID Card Number');
				$nationalIDCardScanLabel = $_SESSION[$guid]['country'].' '.__('ID Card Scan');
				$residencyStatusLabel = $_SESSION[$guid]['country'].' '.__('Residency/Visa Type');
				$visaExpiryDateLabel = $_SESSION[$guid]['country'].' '.__('Visa Expiry Date');
			} else {
				$nationalIDCardNumberLabel = __('National ID Card Number');
				$nationalIDCardScanLabel = __('National ID Card Scan');
				$residencyStatusLabel = __('Residency/Visa Type');
				$visaExpiryDateLabel = __('Visa Expiry Date');
			}

			$row = $form->addRow();
				$row->addLabel('nationalIDCardNumber', $nationalIDCardNumberLabel);
				$row->addTextField('nationalIDCardNumber')->maxLength(30);

			$row = $form->addRow();
				$row->addLabel('nationalIDCardScan', $nationalIDCardScanLabel)->description(__('Less than 1440px by 900px').'. '.__('Accepts PDF files.'));
				$row->addFileUpload('nationalIDCardScan')
					->accepts('.jpg,.jpeg,.gif,.png,.pdf')
					->setMaxUpload(false)
					->setAttachment('nationalIDCardScanCurrent', $_SESSION[$guid]['absoluteURL'], $values['nationalIDCardScan']);

			$residencyStatusList = getSettingByScope($connection2, 'User Admin', 'residencyStatus');

			$row = $form->addHiddenValue('residencyStatus', ''); //GS//

			$row = $form->addHiddenValue('visaExpiryDateLabel', ''); //GS//

			// EMPLOYMENT
			if ($parent || $student) { //GS//
				$form->addRow()->addHeading(__('Employment'));

				$row = $form->addRow();
					$row->addLabel('profession', __('Profession'));
					$row->addTextField('profession')->maxLength(90);

				$row = $form->addRow();
					$row->addLabel('employer', __('Employer'));
					$row->addTextField('employer')->maxLength(90);

				$row = $form->addRow();
					$row->addLabel('jobTitle', __('Job Title'));
					$row->addTextField('jobTitle')->maxLength(90);

        //GS//$row = $form->addRow(); //GS//
				//GS//	$row->addLabel('salary', __('Salary')); //GS//
				//GS//	$row->addTextField('salary')->maxLength(30); //GS//
			}

			// EMERGENCY CONTACTS
			if ($student || $staff) {
				$form->addRow()->addHeading(__('Emergency Contacts'));

				$form->addRow()->addContent(__('These details are used when immediate family members (e.g. parent, spouse) cannot be reached first. Please try to avoid listing immediate family members.'));

				$row = $form->addRow();
					$row->addLabel('emergency1Name', __('Contact 1 Name'));
					$row->addTextField('emergency1Name')->maxLength(90);

				$row = $form->addRow();
					$row->addLabel('emergency1Relationship', __('Contact 1 Relationship'));
					$row->addSelectEmergencyRelationship('emergency1Relationship');

				$row = $form->addRow();
					$row->addLabel('emergency1Number1', __('Contact 1 Number 1'));
					$row->addTextField('emergency1Number1')->maxLength(30);

				$row = $form->addRow();
					$row->addLabel('emergency1Number2', __('Contact 1 Number 2'));
					$row->addTextField('emergency1Number2')->maxLength(30);

				$row = $form->addRow();
					$row->addLabel('emergency2Name', __('Contact 2 Name'));
					$row->addTextField('emergency2Name')->maxLength(90);

				$row = $form->addRow();
					$row->addLabel('emergency2Relationship', __('Contact 2 Relationship'));
					$row->addSelectEmergencyRelationship('emergency2Relationship');

				$row = $form->addRow();
					$row->addLabel('emergency2Number1', __('Contact 2 Number 1'));
					$row->addTextField('emergency2Number1')->maxLength(30);

				$row = $form->addRow();
					$row->addLabel('emergency2Number2', __('Contact 2 Number 2'));
					$row->addTextField('emergency2Number2')->maxLength(30);
			}

			// MISCELLANEOUS
      $form->addHiddenValue('gibbonHouseID', ''); //GS//

      $form->addHiddenValue('studentID', ''); //GS//
      $form->addHiddenValue('transport', ''); //GS//
      $form->addHiddenValue('transportNotes', ''); //GS//
      $form->addHiddenValue('lockerNumber', ''); //GS//
      $form->addHiddenValue('vehicleRegistration', ''); //GS//

      if ($student) {
				$privacySetting = getSettingByScope($connection2, 'User Admin', 'privacy');
				$privacyOptions = getSettingByScope($connection2, 'User Admin', 'privacyOptions');

				if ($privacySetting == 'Y' && !empty($privacyOptions)) {
                    $options = array_map('trim', explode(',', $privacyOptions));
                    $values['privacyOptions'] = array_map('trim', explode(',', $values['privacy']));

					$row = $form->addRow();
						$row->addLabel('privacyOptions[]', __('Privacy'))->description(__('Check to indicate which privacy options are required.'));
						$row->addCheckbox('privacyOptions[]')->fromArray($options)->checked($values['privacyOptions'])->addClass('md:max-w-lg');
				}

				$studentAgreementOptions = getSettingByScope($connection2, 'School Admin', 'studentAgreementOptions');
				if (!empty($studentAgreementOptions)) {
                    $options = array_map('trim', explode(',', $studentAgreementOptions));
                    $values['studentAgreements'] = array_map('trim', explode(',', $values['studentAgreements']));

					$row = $form->addRow();
					$row->addLabel('studentAgreements[]', __('Student Agreements'))->description(__('Check to indicate that student has signed the relevant agreement.'));
					$row->addCheckbox('studentAgreements[]')->fromArray($options)->checked($values['studentAgreements']);
				}
			}

			// CUSTOM FIELDS
			$existingFields = (isset($values['fields']))? unserialize($values['fields']) : null;
			$resultFields = getCustomFields($connection2, $guid, $student, $staff, $parent, $other);
			if ($resultFields->rowCount() > 0) {
				$heading = $form->addRow()->addHeading(__('Custom Fields'));

				while ($rowFields = $resultFields->fetch()) {
					$name = 'custom'.$rowFields['gibbonPersonFieldID'];
					$value = (isset($existingFields[$rowFields['gibbonPersonFieldID']]))? $existingFields[$rowFields['gibbonPersonFieldID']] : '';

					$row = $form->addRow();
						$row->addLabel($name, $rowFields['name'])->description($rowFields['description']);
						$row->addCustomField($name, $rowFields)->setValue($value);
				}
			}

			$row = $form->addRow();
				$row->addFooter()->append('<small>'.getMaxUpload($guid, true).'</small>');
				$row->addSubmit();

			$form->loadAllValuesFrom($values);

			echo $form->getOutput();
            ?>

			<!-- CONTROLS FOR STATUS -->
			<script type="text/javascript">
				$(document).ready(function(){
					$("#status").change(function(){
						if ($('#status').val()=="Left" ) {
							alert("As you have marked this person as left, please consider setting the End Date field.") ;
						}
						else if ($('#status').val()=="Full" ) {
							alert("As you have marked this person as full, please consider setting the Start Date field.") ;
						}
						else if ($('#status').val()=="Expected" ) {
							alert("As you have marked this person as expected, please consider setting the Start Date field.") ;
						}
						});
				});
			</script>

			<?php
        }
    }
}
