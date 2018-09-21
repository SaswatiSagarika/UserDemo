<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImportCSVService
 *
 */
namespace Sch\MainBundle\Service;


class ImportCSVService extends BaseBlockService
{

    /**
     * Function to import Users
     *
     * @param $sheet    obejct(PHPExcel_Worksheet)
     *
     * @return array
     *
     **/
    public function uploadUsers($sheet)
    {
        $returnData['successMessage'] = '';
        $returnData['errorMessage']    = '';

        // Getting values from csv file
        $name  = trim(strtolower($sheet->getCell('A1')->getValue()));
        $last  = trim(strtolower($sheet->getCell('B1')->getValue()));
        $phone1= trim(strtolower($sheet->getCell('C1')->getValue()));
        $phone2= trim(strtolower($sheet->getCell('D1')->getValue()));
        $phone3= trim(strtolower($sheet->getCell('E1')->getValue()));
        
        // Validating header
        if ('name' !== $name ||'last' !== $last ||
            'phone1' !== $phone1 ||
            'phone2' !== $phone2 ||'phone3' !== $phone3) {

            $returnData['errorMessage'] = 'Header not proper';
            return $returnData;
        }

        return $returnData;
    }


}
