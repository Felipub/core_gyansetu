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

namespace Gibbon\Domain\Students;

use Gibbon\Domain\Traits\TableAware;
use Gibbon\Domain\Traits\SharedUserLogic;
use Gibbon\Domain\QueryCriteria;
use Gibbon\Domain\QueryableGateway;

/**
 * @version v16
 * @since   v16
 */
class StudentGateway extends QueryableGateway
{
    use TableAware;
    use SharedUserLogic;

    private static $tableName = 'gibbonStudentEnrolment';

    private static $searchableColumns = ['gibbonPerson.preferredName', 'gibbonPerson.surname', 'gibbonPerson.username', 'gibbonPerson.email', 'gibbonPerson.emailAlternate', 'gibbonPerson.studentID', 'gibbonPerson.phone1', 'gibbonPerson.vehicleRegistration'];

    /**
     * @param QueryCriteria $criteria
     * @return DataSet
     */
    public function queryStudentsBySchoolYear(QueryCriteria $criteria, $gibbonSchoolYearID, $searchFamilyDetails = false)
    {
        $query = $this
            ->newQuery()
            ->distinct()
            ->from('gibbonPerson')
            ->cols([
                'gibbonPerson.gibbonPersonID', 'gibbonPerson.username AS username', 'gibbonStudentEnrolmentID', 'gibbonPerson.title', 'gibbonPerson.preferredName', 'gibbonPerson.surname', 'gibbonPerson.image_240', 'gibbonYearGroup.nameShort AS yearGroup', 'gibbonRollGroup.nameShort AS rollGroup', 'gibbonStudentEnrolment.rollOrder', 'gibbonPerson.dateStart', 'gibbonPerson.dateEnd', 'gibbonPerson.status', "'Student' as roleCategory"
            ])
            ->leftJoin('gibbonStudentEnrolment', 'gibbonPerson.gibbonPersonID=gibbonStudentEnrolment.gibbonPersonID AND gibbonStudentEnrolment.gibbonSchoolYearID = :gibbonSchoolYearID')
            ->leftJoin('gibbonYearGroup', 'gibbonStudentEnrolment.gibbonYearGroupID=gibbonYearGroup.gibbonYearGroupID')
            ->leftJoin('gibbonRollGroup', 'gibbonStudentEnrolment.gibbonRollGroupID=gibbonRollGroup.gibbonRollGroupID')
            ->bindValue('gibbonSchoolYearID', $gibbonSchoolYearID);

        if ($criteria->hasFilter('all')) {
            $query->innerJoin('gibbonRole', 'FIND_IN_SET(gibbonRole.gibbonRoleID, gibbonPerson.gibbonRoleIDAll)')
                  ->where("gibbonRole.category='Student'");
        } else {
            $query->where("gibbonStudentEnrolment.gibbonStudentEnrolmentID IS NOT NULL")
                  ->where("gibbonPerson.status = 'Full'")
                  ->where('(gibbonPerson.dateStart IS NULL OR gibbonPerson.dateStart <= :today)')
                  ->where('(gibbonPerson.dateEnd IS NULL OR gibbonPerson.dateEnd >= :today)')
                  ->bindValue('today', date('Y-m-d'));
        }

        if ($searchFamilyDetails && $criteria->hasSearchText()) {
            self::$searchableColumns = array_merge(self::$searchableColumns, ['parent1.email', 'parent1.emailAlternate', 'parent2.email', 'parent2.emailAlternate']);

            $query
                ->leftJoin('gibbonFamilyChild as child', "child.gibbonPersonID=gibbonPerson.gibbonPersonID")
                ->leftJoin('gibbonFamilyAdult as adult1', "(adult1.gibbonFamilyID=child.gibbonFamilyID AND adult1.contactPriority=1)")
                ->leftJoin('gibbonPerson as parent1', "(parent1.gibbonPersonID=adult1.gibbonPersonID AND parent1.status='Full')")
                ->leftJoin('gibbonFamilyAdult as adult2', "(adult2.gibbonFamilyID=child.gibbonFamilyID AND adult2.contactPriority=2)")
                ->leftJoin('gibbonPerson as parent2', "(parent2.gibbonPersonID=adult2.gibbonPersonID AND parent2.status='Full')");
        }

        $criteria->addFilterRules($this->getSharedUserFilterRules());

        return $this->runQuery($query, $criteria);
    }

    public function queryStudentEnrolmentBySchoolYear(QueryCriteria $criteria, $gibbonSchoolYearID)
    {
        $query = $this
            ->newQuery()
            ->from('gibbonPerson')
            ->cols([
                'gibbonPerson.gibbonPersonID', 'gibbonStudentEnrolmentID', 'gibbonPerson.title', 'gibbonPerson.preferredName', 'gibbonPerson.surname', 'gibbonPerson.image_240', 'gibbonYearGroup.nameShort AS yearGroup', 'gibbonRollGroup.nameShort AS rollGroup', 'gibbonStudentEnrolment.rollOrder', 'gibbonPerson.dateStart', 'gibbonPerson.dateEnd', 'gibbonPerson.status', "'Student' as roleCategory"
            ])
            ->innerJoin('gibbonStudentEnrolment', 'gibbonPerson.gibbonPersonID=gibbonStudentEnrolment.gibbonPersonID')
            ->innerJoin('gibbonYearGroup', 'gibbonStudentEnrolment.gibbonYearGroupID=gibbonYearGroup.gibbonYearGroupID')
            ->innerJoin('gibbonRollGroup', 'gibbonStudentEnrolment.gibbonRollGroupID=gibbonRollGroup.gibbonRollGroupID')
            ->where('gibbonStudentEnrolment.gibbonSchoolYearID = :gibbonSchoolYearID')
            ->bindValue('gibbonSchoolYearID', $gibbonSchoolYearID);

        $criteria->addFilterRules($this->getSharedUserFilterRules());

        return $this->runQuery($query, $criteria);
    }

    public function queryStudentEnrolmentByRollGroup(QueryCriteria $criteria, $gibbonRollGroupID = null)
    {
        $query = $this
            ->newQuery()
            ->from('gibbonPerson as child')
            ->cols([
                'child.username', 'child.gibbonPersonID', 'gibbonStudentEnrolmentID', 'gibbonStudentEnrolment.gibbonSchoolYearID', 'child.title', 'child.preferredName', 'child.firstName', 'child.surname', 'child.image_240', 'gibbonYearGroup.nameShort AS yearGroup', 'gibbonYearGroup.name AS yearGroupName', 'gibbonRollGroup.nameShort AS rollGroup', 'gibbonStudentEnrolment.rollOrder', 'child.dateStart', 'child.dateEnd', 'child.status', "'Student' as roguarleCategory", 'child.gender as gender', 'child.dob as dob', 'child.citizenship1 as citizenship1', 'child.citizenship2 as citizenship2', 'child.transport as transport', 'child.religion as religion', 'child.lockerNumber as lockerNumber', 'child.privacy as privacy',
                'guardian1.preferredName as g1name', 'guardian1.surname as g1surname', 'guardian1.phone1 as g1phone', 'guardian1.profession as g1profession',
//                'guardian2.preferredName as g2name', 'guardian2.surname as g2surname', 'guardian2.phone1 as g2phone', 'guardian2.profession as g2profession',
            ])
            ->innerJoin('gibbonStudentEnrolment', 'child.gibbonPersonID=gibbonStudentEnrolment.gibbonPersonID')
            ->innerJoin('gibbonYearGroup', 'gibbonStudentEnrolment.gibbonYearGroupID=gibbonYearGroup.gibbonYearGroupID')
            ->innerJoin('gibbonRollGroup', 'gibbonStudentEnrolment.gibbonRollGroupID=gibbonRollGroup.gibbonRollGroupID')
            ->leftJoin('gibbonFamilyChild', 'child.gibbonPersonID=gibbonFamilyChild.gibbonPersonID')
            ->leftJoin('gibbonFamilyAdult as adult1', 'gibbonFamilyChild.gibbonFamilyID=adult1.gibbonFamilyID AND adult1.contactPriority = 1')
//            ->leftJoin('gibbonFamilyAdult as adult2', 'gibbonFamilyChild.gibbonFamilyID=adult2.gibbonFamilyID AND adult2.contactPriority = 2')
            ->leftJoin('gibbonPerson as guardian1', 'adult1.gibbonPersonID=guardian1.gibbonPersonID')
//            ->leftJoin('gibbonPerson as guardian2', 'adult2.gibbonPersonID=guardian2.gibbonPersonID')
            ->where("child.status = 'Full'")
            ->where('(child.dateStart IS NULL OR child.dateStart <= :today)')
            ->where('(child.dateEnd IS NULL OR child.dateEnd >= :today)')
//            ->where('(adult1.contactPriority = 1)')
//            ->where('(adult2.contactPriority = 2)')
            ->bindValue('today', date('Y-m-d'));

        if (!empty($gibbonRollGroupID)) {
            $query
                ->where('gibbonStudentEnrolment.gibbonRollGroupID = :gibbonRollGroupID')
                ->bindValue('gibbonRollGroupID', $gibbonRollGroupID);
        }

        $criteria->addFilterRules($this->getSharedUserFilterRules());

        $criteria->addFilterRules([
            'view' => function ($query, $view) {
                if ($view == 'extended') {
                    $query->cols(['gibbonHouse.name as house', 'gibbonPersonMedical.*', 'COUNT(gibbonPersonMedicalConditionID) as conditionCount'])
                        ->leftJoin('gibbonHouse', 'gibbonHouse.gibbonHouseID=child.gibbonHouseID')
                        ->leftJoin('gibbonPersonMedical', 'gibbonPersonMedical.gibbonPersonID=child.gibbonPersonID')
                        ->leftJoin('gibbonPersonMedicalCondition', 'gibbonPersonMedicalCondition.gibbonPersonMedicalID=gibbonPersonMedical.gibbonPersonMedicalID')
                        ->groupBy(['child.gibbonPersonID']);
                }
                return $query;
            },
        ]);

        return $this->runQuery($query, $criteria);
    }

    public function queryStudentsAndTeachersBySchoolYear(QueryCriteria $criteria, $gibbonSchoolYearID)
    {
        $query = $this
            ->newQuery()
            ->distinct()
            ->from('gibbonPerson')
            ->cols([
                'gibbonPerson.gibbonPersonID', 'gibbonStudentEnrolmentID', 'gibbonPerson.title', 'gibbonPerson.preferredName', 'gibbonPerson.surname', 'gibbonPerson.image_240', 'gibbonYearGroup.nameShort AS yearGroup', 'gibbonRollGroup.nameShort AS rollGroup', 'gibbonStudentEnrolment.rollOrder', 'gibbonPerson.dateStart', 'gibbonPerson.dateEnd', 'gibbonPerson.status', 'gibbonRole.category as roleCategory', 'gibbonStaff.type as staffType'
            ])
            ->innerJoin('gibbonRole', 'FIND_IN_SET(gibbonRole.gibbonRoleID, gibbonPerson.gibbonRoleIDAll)')
            ->leftJoin('gibbonStudentEnrolment', 'gibbonPerson.gibbonPersonID=gibbonStudentEnrolment.gibbonPersonID AND gibbonStudentEnrolment.gibbonSchoolYearID = :gibbonSchoolYearID')
            ->leftJoin('gibbonYearGroup', 'gibbonStudentEnrolment.gibbonYearGroupID=gibbonYearGroup.gibbonYearGroupID')
            ->leftJoin('gibbonRollGroup', 'gibbonStudentEnrolment.gibbonRollGroupID=gibbonRollGroup.gibbonRollGroupID')
            ->leftJoin('gibbonStaff', "gibbonStaff.gibbonPersonID=gibbonPerson.gibbonPersonID")
            ->bindValue('gibbonSchoolYearID', $gibbonSchoolYearID)

            ->groupBy(['gibbonPerson.gibbonPersonID']);

        if ($criteria->hasFilter('all')) {
            $query->where("(gibbonPerson.status = 'Full' OR gibbonPerson.status = 'Expected')");
        } else {
            $query->where("(gibbonStudentEnrolment.gibbonStudentEnrolmentID IS NOT NULL OR (gibbonStaff.gibbonStaffID IS NOT NULL AND gibbonRole.category='Staff') )")
                  ->where("gibbonPerson.status = 'Full'")
                  ->where('(gibbonPerson.dateStart IS NULL OR gibbonPerson.dateStart <= :today)')
                  ->where('(gibbonPerson.dateEnd IS NULL OR gibbonPerson.dateEnd >= :today)')
                  ->bindValue('today', date('Y-m-d'));
        }

        $criteria->addFilterRules($this->getSharedUserFilterRules());

        return $this->runQuery($query, $criteria);
    }

    public function selectActiveStudentsByFamilyAdult($gibbonSchoolYearID, $gibbonPersonID)
    {
        $data = array('gibbonSchoolYearID' => $gibbonSchoolYearID, 'gibbonPersonID' => $gibbonPersonID, 'today' => date('Y-m-d'));
        $sql = "SELECT gibbonPerson.gibbonPersonID, title, surname, preferredName, image_240, gibbonYearGroup.nameShort AS yearGroup, gibbonRollGroup.nameShort AS rollGroup, 'Student' as roleCategory
                FROM gibbonFamilyAdult
                JOIN gibbonFamilyChild ON (gibbonFamilyChild.gibbonFamilyID=gibbonFamilyAdult.gibbonFamilyID)
                JOIN gibbonPerson ON (gibbonFamilyChild.gibbonPersonID=gibbonPerson.gibbonPersonID)
                JOIN gibbonStudentEnrolment ON (gibbonPerson.gibbonPersonID=gibbonStudentEnrolment.gibbonPersonID)
                JOIN gibbonYearGroup ON (gibbonStudentEnrolment.gibbonYearGroupID=gibbonYearGroup.gibbonYearGroupID)
                JOIN gibbonRollGroup ON (gibbonStudentEnrolment.gibbonRollGroupID=gibbonRollGroup.gibbonRollGroupID)
                WHERE gibbonFamilyAdult.gibbonPersonID=:gibbonPersonID
                AND gibbonFamilyAdult.childDataAccess='Y'
                AND gibbonStudentEnrolment.gibbonSchoolYearID=:gibbonSchoolYearID
                AND gibbonPerson.status='Full'
                AND (dateStart IS NULL OR dateStart<=:today)
                AND (dateEnd IS NULL  OR dateEnd>=:today)
                GROUP BY gibbonPerson.gibbonPersonID
                ORDER BY surname, preferredName";

        return $this->db()->select($sql, $data);
    }

    public function selectActiveStudentByPerson($gibbonSchoolYearID, $gibbonPersonID)
    {
        $data = array('gibbonSchoolYearID' => $gibbonSchoolYearID, 'gibbonPersonID' => $gibbonPersonID, 'today' => date('Y-m-d'));
        $sql = "SELECT gibbonPerson.gibbonPersonID, title, surname, preferredName, image_240, gibbonYearGroup.gibbonYearGroupID, gibbonYearGroup.nameShort AS yearGroup, gibbonRollGroup.gibbonRollGroupID, gibbonRollGroup.nameShort AS rollGroup, 'Student' as roleCategory
                FROM gibbonPerson
                JOIN gibbonStudentEnrolment ON (gibbonPerson.gibbonPersonID=gibbonStudentEnrolment.gibbonPersonID)
                JOIN gibbonYearGroup ON (gibbonStudentEnrolment.gibbonYearGroupID=gibbonYearGroup.gibbonYearGroupID)
                JOIN gibbonRollGroup ON (gibbonStudentEnrolment.gibbonRollGroupID=gibbonRollGroup.gibbonRollGroupID)
                WHERE gibbonPerson.gibbonPersonID=:gibbonPersonID
                AND gibbonPerson.status='Full'
                AND (dateStart IS NULL OR dateStart<=:today)
                AND (dateEnd IS NULL  OR dateEnd>=:today)
                AND gibbonStudentEnrolment.gibbonSchoolYearID=:gibbonSchoolYearID";

        return $this->db()->select($sql, $data);
    }

    public function selectAllStudentEnrolmentsByPerson($gibbonPersonID)
    {
        $data = array('gibbonPersonID' => $gibbonPersonID);
        $sql = "SELECT *
                FROM gibbonStudentEnrolment
                JOIN gibbonSchoolYear ON (gibbonStudentEnrolment.gibbonSchoolYearID=gibbonSchoolYear.gibbonSchoolYearID)
                WHERE gibbonPersonID=:gibbonPersonID
                AND (gibbonSchoolYear.status='Current' OR gibbonSchoolYear.status='Past')
                ORDER BY sequenceNumber DESC";

        return $this->db()->select($sql, $data);
    }

    public function getStudentEnrolmentCount($gibbonSchoolYearID)
    {
        $data = ['gibbonSchoolYearID' => $gibbonSchoolYearID, 'today' => date('Y-m-d')];
        $sql = "SELECT COUNT(gibbonPerson.gibbonPersonID)
                FROM gibbonPerson
                JOIN gibbonStudentEnrolment ON (gibbonPerson.gibbonPersonID=gibbonStudentEnrolment.gibbonPersonID)
                JOIN gibbonRollGroup ON (gibbonStudentEnrolment.gibbonRollGroupID=gibbonRollGroup.gibbonRollGroupID)
                WHERE gibbonRollGroup.gibbonSchoolYearID=:gibbonSchoolYearID
                AND status='FULL' AND (dateStart IS NULL OR dateStart<=:today) AND (dateEnd IS NULL  OR dateEnd>=:today)";

        return $this->db()->selectOne($sql, $data);
    }
}
