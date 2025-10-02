<?php 
    
    session_start();
    include_once '../../../configuration/connection-config.php';

    if(isset($_GET['type']))
    {
        if ($_GET['type'] == 'ACADLEVEL')
        {
            $qry = "
                    SELECT DISTINCT `LVL`.`SchlAcadLvlSms_ID` `ID`, 
                                    `LVL`.`SchlAcadLvl_NAME` `NAME`

                    FROM `schoolenrollmentinvoice` `INV`

                        LEFT JOIN `schoolacademiclevel` `LVL`
                            ON `INV`.`SchlAcadLvl_ID` = `LVL`.`SchlAcadLvlSms_ID`

                    WHERE   `INV`.`SchlStud_ID` = " . $_SESSION['USERID'] . " AND
                            `INV`.`SchlEnrollInv_STATUS` = 1 AND 
                            `INV`.`SchlEnrollInv_ISACTIVE` = 1 AND 
                            `INV`.`SchlEnrollInv_ISCANCEL` = 0 ";

            $rsreg = $dbConn->query($qry);
            $fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
        }

        else if ($_GET['type'] == 'ACADYEAR')
        {
            $qry =  "
                    SELECT DISTINCT `YR`.`SchlAcadYrSms_ID` `ID`,
                                    `YR`.`SchlAcadYr_NAME` `NAME`

                    FROM `schoolenrollmentinvoice` `INV`

                        LEFT JOIN `schoolacademicyear` `YR`
                            ON `INV`.`SchlAcadYR_ID` = `YR`.`SchlAcadYrSms_ID`

                    WHERE   `INV`.`SchlStud_ID` = " . $_SESSION['USERID'] . " AND
                            `INV`.`SchlAcadLvl_ID` = " . $_GET['levelid'] . " AND
                            `INV`.`SchlEnrollInv_STATUS` = 1 AND 
                            `INV`.`SchlEnrollInv_ISACTIVE` = 1 AND 
                            `INV`.`SchlEnrollInv_ISCANCEL` = 0";
            $rsreg = $dbConn->query($qry);
            $fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
        }

        else if ($_GET['type'] == 'ACADPERIOD')
        {
            $qry = "
                    SELECT DISTINCT `PRD`.`SchlAcadPrdSms_ID` `ID`,
                                    `PRD`.`SchlAcadPrd_NAME` `NAME`

                    FROM `schoolenrollmentinvoice` `INV`

                        LEFT JOIN `schoolacademicperiod` `PRD`
                            ON `INV`.`SchlAcadPRD_ID` = `PRD`.`SchlAcadPrdSms_ID`

                    WHERE   `INV`.`SchlStud_ID` = " . $_SESSION['USERID'] . " AND
                            `INV`.`SchlAcadLvl_ID` = " . $_GET['levelid'] . " AND
                            `INV`.`SchlAcadYr_ID` = " . $_GET['yearid'] . " AND
                            `INV`.`SchlEnrollInv_STATUS` = 1 AND 
                            `INV`.`SchlEnrollInv_ISACTIVE` = 1 AND 
                            `INV`.`SchlEnrollInv_ISCANCEL` = 0";
            $rsreg = $dbConn->query($qry);
            $fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
        }
        else if ($_GET['type'] == 'ACADCOURSE')
        {
            $qry = "
                    SELECT DISTINCT `CRS`.`SchlAcadCrseSms_ID` `ID`,
                                    `CRS`.`SchlAcadCrses_NAME` `NAME`

                    FROM `schoolenrollmentassessment` `ASS`
                        
                        LEFT JOIN `schoolenrollmentinvoice` `INV`
                            ON `ASS`.`SchlEnrollAssSms_ID` = `INV`.`SchlEnrollAss_ID`
                            
                        LEFT JOIN `schoolacademiccourses` `CRS`
                            ON `ASS`.`SchlAcadCrse_ID` = `CRS`.`SchlAcadCrseSms_ID` 

                    WHERE   `INV`.`SchlStud_ID` = " . $_SESSION['USERID'] . " AND
                            `INV`.`SchlAcadLvl_ID` = " . $_GET['levelid'] . " AND
                            `INV`.`SchlAcadYr_ID` = " . $_GET['yearid'] . " AND
                            `INV`.`SchlAcadPrd_ID` = " . $_GET['periodid'] . " AND
                            `INV`.`SchlEnrollInv_STATUS` = 1 AND 
                            `INV`.`SchlEnrollInv_ISACTIVE` = 1 AND 
                            `INV`.`SchlEnrollInv_ISCANCEL` = 0";
            $rsreg = $dbConn->query($qry);
            $fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
        

        }
        else if ($_GET['type'] == 'PAYMENT-HEADER')
        {
            $qry = " 
                    SELECT DISTINCT `CRS`.`SchlAcadCrses_NAME` `COURSE`,
                                    CONCAT(`PRD`.`SchlAcadPrd_NAME`,'(', `YR`.`SchlAcadYr_NAME`, ')' ) `PERIOD`
    
                    FROM `schoolenrollmentassessment` `ASS`
                        
                        LEFT JOIN `schoolenrollmentinvoice` `INV`
                            ON `ASS`.`SchlEnrollAssSms_ID` = `INV`.`SchlEnrollAss_ID`
                            
                        LEFT JOIN `schoolacademiccourses` `CRS`
                            ON `ASS`.`SchlAcadCrse_ID` = `CRS`.`SchlAcadCrseSms_ID` 
                        
                        LEFT JOIN `schoolacademicyear` `YR`
                            ON `INV`.`SchlAcadYR_ID` = `YR`.`SchlAcadYrSms_ID`
                            
                        LEFT JOIN `schoolacademicperiod` `PRD`
                            ON `INV`.`SchlAcadPRD_ID` = `PRD`.`SchlAcadPrdSms_ID`
        
                        WHERE   `INV`.`SchlStud_ID` = " . $_SESSION['USERID'] . " AND
                                `INV`.`SchlAcadLvl_ID` = " . $_GET['levelid'] . " AND
                                `INV`.`SchlAcadYr_ID` = " . $_GET['yearid'] . " AND
                                `INV`.`SchlAcadPrd_ID` = " . $_GET['periodid'] . " AND
                                `CRS`.`SchlAcadCrseSms_ID`  = " . $_GET['courseid'] . " AND 
                                `INV`.`SchlEnrollInv_STATUS` = 1 AND 
                                `INV`.`SchlEnrollInv_ISACTIVE` = 1 AND 
                                `INV`.`SchlEnrollInv_ISCANCEL` = 0";
            $rsreg = $dbConn->query($qry);
            $fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);
        }
        else if ($_GET['type'] == 'PAYMENT-HISTORY')
        {
            $qry = "
                    SELECT  `INV`.`SchlEnrollInv_DATE` `DATE`,
                            `INV`.`SchlEnrollInv_ORNO` `ORNO`,
                            `INV`.`SchlEnrollInv_AMT_TENDERED` `AMOUNT` 
    
                    FROM `schoolenrollmentassessment` `ASS`

                        LEFT JOIN `schoolenrollmentinvoice` `INV`
                            ON `ASS`.`SchlEnrollAssSms_ID` = `INV`.`SchlEnrollAss_ID`
                            
                        LEFT JOIN `schoolacademiccourses` `CRS`
                            ON `ASS`.`SchlAcadCrse_ID` = `CRS`.`SchlAcadCrseSms_ID` 

                        LEFT JOIN `schoolacademicyear` `YR`
                            ON `INV`.`SchlAcadYR_ID` = `YR`.`SchlAcadYrSms_ID`
                            
                        LEFT JOIN `schoolacademicperiod` `PRD`
                            ON `INV`.`SchlAcadPRD_ID` = `PRD`.`SchlAcadPrdSms_ID`

                    WHERE   `INV`.`SchlStud_ID` = " . $_SESSION['USERID'] . " AND
                            `INV`.`SchlAcadLvl_ID` = " . $_GET['levelid'] . " AND
                            `INV`.`SchlAcadYr_ID` = " . $_GET['yearid'] . " AND
                            `INV`.`SchlAcadPrd_ID` = " . $_GET['periodid'] . " AND
                            `CRS`.`SchlAcadCrseSms_ID`  = " . $_GET['courseid'] . " AND
                            `INV`.`SchlEnrollInv_STATUS` = 1 AND 
                            `INV`.`SchlEnrollInv_ISACTIVE` = 1 AND 
                            `INV`.`SchlEnrollInv_ISCANCEL` = 0";
            $rsreg = $dbConn->query($qry);
            $fetch = $rsreg->fetch_ALL(MYSQLI_ASSOC);

            
        }







        $rsreg->free_result();
        $dbConn->close();
        echo json_encode($fetch);
    }

?>