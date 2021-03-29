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

include '../../gibbon.php';

$gibbonYearGroupIDList = (isset($_POST['gibbonYearGroupIDList']))? $_POST['gibbonYearGroupIDList'] : null;
$gibbonSchoolYearID = (isset($_POST['gibbonSchoolYearID']))? $_POST['gibbonSchoolYearID'] : null;

$URL = $_SESSION[$guid]['absoluteURL'].'/index.php?q=/modules/'.getModuleName($_POST['address']).'/courseEnrolment_sync_run.php&gibbonSchoolYearID='.$gibbonSchoolYearID.'&gibbonYearGroupIDList='.$gibbonYearGroupIDList;
$URLSuccess = $_SESSION[$guid]['absoluteURL'].'/index.php?q=/modules/'.getModuleName($_POST['address']).'/courseEnrolment_sync.php';

if (isActionAccessible($guid, $connection2, '/modules/Timetable Admin/courseEnrolment_sync_run.php') == false) {
    $URL .= '&return=error0';
    header("Location: {$URL}");
    exit;
} else {
    //Proceed!
    $syncData = (isset($_POST['syncData']))? $_POST['syncData'] : false;

    //DEBUG//die(var_dump($syncData));//DEBUG//
    //DEBUG//die("DATA: ".var_dump($data)."\nPDO: ".var_dump($pdo));//DEBUG//

    if (empty($gibbonYearGroupIDList) || empty($gibbonSchoolYearID) || empty($syncData)) {
        $URL .= '&return=error1';
        header("Location: {$URL}");
        exit;
    } else {
        $partialFail = false;

        foreach ($syncData as $gibbonRollGroupID => $usersToEnrol) {
            if (empty($usersToEnrol)) continue;

            foreach ($usersToEnrol as $gibbonPersonID => $role) {
                $data = array(
                    'gibbonRollGroupID' => $gibbonRollGroupID,
                    'gibbonPersonID' => $gibbonPersonID,
                    'role' => $role,
                );

//GS//
                if ($role == 'Stuent') {
                  $sql = "INSERT INTO gibbonCourseClassPerson (`gibbonCourseClassID`, `gibbonPersonID`, `role`, `reportable`)
                          SELECT DISTINCT gibbonCourseClassMap.gibbonCourseClassID, :gibbonPersonID, :role, 'Y'
                          FROM gibbonCourseClassMap
                          LEFT JOIN gibbonCourseClassPerson	ON (gibbonCourseClassPerson.gibbonPersonID=:gibbonPersonID
                            AND gibbonCourseClassPerson.gibbonCourseClassID=gibbonCourseClassMap.gibbonCourseClassID
                            AND gibbonCourseClassPerson.role=:role)
                          LEFT JOIN gibbonStudentEnrolment ON gibbonStudentEnrolment.gibbonPersonID=:gibbonPersonID
                          WHERE gibbonCourseClassMap.gibbonYearGroupID=gibbonStudentEnrolment.gibbonYearGroupID
                          	AND gibbonCourseClassMap.gibbonRollGroupID=:gibbonRollGroupID
                            AND gibbonCourseClassMap.gibbonRollGroupID=gibbonStudentEnrolment.gibbonRollGroupID
                          	AND gibbonCourseClassPerson.gibbonCourseClassPersonID IS NULL";
                }
                else {
                  $sql = "INSERT INTO gibbonCourseClassPerson (`gibbonCourseClassID`, `gibbonPersonID`, `role`, `reportable`)
                          SELECT DISTINCT gibbonCourseClassMap.gibbonCourseClassID, :gibbonPersonID, :role, 'Y'
                          FROM gibbonCourseClassMap
                          LEFT JOIN gibbonCourseClassPerson	ON (gibbonCourseClassPerson.gibbonPersonID=:gibbonPersonID
                            AND gibbonCourseClassPerson.gibbonCourseClassID=gibbonCourseClassMap.gibbonCourseClassID
                            AND gibbonCourseClassPerson.role=:role)
                          WHERE gibbonCourseClassMap.gibbonRollGroupID=:gibbonRollGroupID
                            AND gibbonCourseClassPerson.gibbonCourseClassPersonID IS NULL";
                }
//GS//

                $pdo->executeQuery($data, $sql);

                if (!$pdo->getQuerySuccess()) $partialFail = true;
            }
        }

        if ($partialFail) {
            $URL .= '&return=warning3';
            header("Location: {$URL}");
            exit;
        } else {
            $URLSuccess .= '&return=success0';
            header("Location: {$URLSuccess}");
            exit;
        }
    }
}
