<?php

/**
 * Controller for Products Section.
 *
 * @author
 *
 * @category Controller
 */
namespace Sch\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sch\MainBundle\Entity\ProductLines;
use Sch\MainBundle\Entity\Product;
use Sch\MainBundle\Entity\ProductTypes;
use Sch\MainBundle\Entity\RetailerTypes;
use Sch\MainBundle\Entity\RetailerCountries;
use Sch\MainBundle\Entity\OrderModes;
use Sch\MainBundle\Entity\Revenue;
use Sch\MainBundle\Entity\RevenueRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RevenueController extends FOSRestController{

	// File: Sch\MainBundle\Controller\RevenueController.php

	/*
	** REST action which returns details based on the search data.
	* Method: GET, url: /api/getRevenue/{_format}
	*
	* @ApiDoc(
	*   resource =false,
	*   description = "Gets a Revenue details based on filter value",
	*  parameters={
	*      {"name"="",
	*      "dataType"="Json",
	*      "required"="true",
	*      "description"="filter details",
	*      "format"="{"year":"2018","productType":"Cooking Gear","productLine":"Camping Equipment","retailerType":"Outdoors Shop",
	"product":"Camping Equipment","retailerCountry":"United States","quarter":"Q1 2012","orderType":"Fax"}"
	*      },
	*  }
	*   statusCodes = {
	*     200 = "Returned when successful",
	*     404 = "Returned when the page is not found"
	*   }
	* )
	*
	*
	*  }
	* @return mixed
	*/
	public function getRevenueDetailAction(Request $request) {
		$demo =[];
		$requestData = $request->query->get('data');
		$demo = json_decode($requestData, true);

		$param = [];
		$param['prodType'] = (array_key_exists('productType', $demo)) ? $demo['productType'] : "";
		$param['prodLine'] = (array_key_exists('productLine', $demo)) ? $demo['productLine'] : "";
		$param['retailCountry'] = (array_key_exists('retailerCountry', $demo)) ? $demo['retailerCountry'] : "";
		$param['retailerType'] = (array_key_exists('retailerType', $demo)) ? $demo['retailerType'] : "";
		$param['product'] = (array_key_exists('product', $demo)) ? $demo['product'] : "";
		$param['year'] = (array_key_exists('year', $demo)) ? $demo['year'] : "";
		$param['orderMode'] = (array_key_exists('orderType', $demo)) ? $demo['orderType'] : "";
		$param['quarter'] = (array_key_exists('quarter', $demo)) ? $demo['quarter'] : "";
		$error = [];
		$em = $this->getDoctrine()->getManager();
		if($param['prodType']){
            $productType = $em->getRepository('MainBundle:ProductTypes')->findOneBy(array('name' => $param['prodType']));

            if(!$productType){
            	$error['productTypeError'] = "Please give a valid Product Type to search";
            }
	    }
		if($param['prodLine']){
            $productLine = $em->getRepository('MainBundle:ProductLines')->findOneBy(array('name' => $param['prodLine']));

            if(!$productLine){
            	$error['productLineError'] = "Please give a valid Product Line to search";
            }
        }
        if($param['retailCountry']){
            $retailerCountry = $em->getRepository('MainBundle:RetailerCountries')->findOneBy(array('name' => $param['retailCountry']));

            if(!$retailerCountry){
            	$error['retailCountryError'] = "Please give a valid Retailer Country to search";
            }
		}
		if($param['retailerType']){       
            $retailerType = $em->getRepository('MainBundle:RetailerTypes')->findOneBy(array('name' => $param['retailerType']));

            if(!$retailerType){
            	$error['retailerTypeError']= "Please give a valid Retailer Type to search";
            }
        }
		if($param['orderMode']){
            $orderType = $em->getRepository('MainBundle:OrderModes')->findOneBy(array('name' => $param['orderMode']));

            if(!$orderType){
            	$error['orderModeError'] = "Please give a valid Order Modes to search";
            }
        }
		if($param['product']){
            $product = $em->getRepository('MainBundle:Product')->findOneBy(array('name' => $param['product']));

            if(!$product){
            	$error['productError'] = "Please give a valid Product to search";
            }
        }
            $revenues = $em->getRepository('MainBundle:Revenue')->revenueDetails($param);
            $resultArray = [];
            $i = 0;
            foreach ($revenues as $revenue) {
            	 $revenueDetails['OrderMode']=(null !== $revenue['OrderMode']) ? $revenue['OrderMode'] : '';
            	 $revenueDetails['RetailerCountry']=(null !== $revenue['RetailerCountry']) ? $revenue['RetailerCountry'] : '';
            	 $revenueDetails['RetailerType']=(null !== $revenue['RetailerType']) ? $revenue['RetailerType'] : '';
            	 $revenueDetails['ProductLine']=(null !== $revenue['ProductLine']) ? $revenue['ProductLine'] : '';
            	 $revenueDetails['ProductType']=(null !== $revenue['ProductType']) ? $revenue['ProductType'] : '';
            	 $revenueDetails['Product']=(null !== $revenue['Product']) ? $revenue['Product'] : '';
            	 $revenueDetails['Year']=(null !== $revenue['Year']) ? $revenue['Year'] : '';
            	 $revenueDetails['Quarter']=(null !== $revenue['Quarter']) ? $revenue['Quarter'] : '';
            	 $revenueDetails['Quantity']=(null !== $revenue['Quantity']) ? $revenue['Quantity'] : '';
            	 $revenueDetails['Revenue']=(null !== $revenue['Revenue']) ? $revenue['Revenue'] : '';
            	 $revenueDetails['GrossMargin']=(null !== $revenue['GrossMargin']) ? $revenue['GrossMargin'] : '';
            	 $resultArray['Revenue'][$i]=$revenueDetails;
            	 $i++;
            }
            if(!$error && !$resultArray){
            	$error['resultError'] = "No records found for this filter";
            }
            $resultArray['Error'] = $error;
             
        return new JsonResponse($resultArray);
            
	}

}
