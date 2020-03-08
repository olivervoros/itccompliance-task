<?php

use PHPUnit\Framework\TestCase;
use App\{ ProductsManager, ApiHelper, ApiDataValidator, Logger };



class ProductsManagerTest extends TestCase
{

    /**
     * @dataProvider apiReturnDataProviderArrayCountSeven
     * @param $returnJSON
     */
    public function testGetListOfProducts_returnsArrayType($returnJSON)
    {
        $apiHelperDouble = $this->getMockBuilder(ApiHelper::class)
            ->setMethodsExcept(['callAPI'])
            ->getMock();

        // STUB
        $apiHelperDouble->method('callAPI')->willReturn($returnJSON);

        $productsManager = new ProductsManager();
        $validator = new ApiDataValidator();

       // DUMMY
        $dummyLogger = $this->createMock(Logger::class);
        $actualRecordsArray = $productsManager->getListOfProducts($apiHelperDouble, $validator, $dummyLogger );

        $this->assertIsArray($actualRecordsArray);
    }

    public function testApiDataValidator_jsonToArray() {

        $validate = new ApiDataValidator();
        $exampleJson = '{"name" : "Oliver"}';
        $actualRecordsArray = $validate->validateApiResult($exampleJson);
        $this->assertIsArray($actualRecordsArray);

        $this->assertSame($actualRecordsArray['name'], "Oliver");
        $this->assertIsString($actualRecordsArray['name']);
    }

    public function testApiDataValidator_isResultEmpty() {

        $dataValidator = new ApiDataValidator();
        $result1 = $dataValidator ->isResultEmpty([]);
        $this->assertSame(true, $result1);
        $this->assertIsBool($result1);

        $result2 = $dataValidator ->isResultEmpty(['Neil', 'Mark', 'John']);
        $this->assertSame(false, $result2);
        $this->assertIsBool($result2);

    }

    public function testApiDataValidator_isResultHasError() {

        $dataValidator = new ApiDataValidator();
        $result1 = $dataValidator->isResultEmpty([]);
        $this->assertSame(true, $result1);
        $this->assertIsBool($result1);

        $result2 = $dataValidator->isResultEmpty(['Neil', 'Mark', 'John']);
        $this->assertSame(false, $result2);
        $this->assertIsBool($result2);

    }

    /**
     * @dataProvider apiReturnDataProviderArrayCountFive
     * @param $returnJSON
     */
    public function testGetListOfProducts_fakeReturnsArrayCountFive($returnJSON) {
        $apiHelperDouble = $this->getMockBuilder(ApiHelper::class)
            ->setMethodsExcept(['callAPI'])
            ->getMock();

        // FAKE
        $apiHelperDouble->method('callAPI')
            ->will($this->returnCallback(
                function () use ($returnJSON) {
                    return $returnJSON;
                }
            ));

        $productsManager = new ProductsManager();
        $dataValidator = new ApiDataValidator();

        // DUMMY
        $dummyLogger = $this->createMock(Logger::class);
        $actualRecordsArray = $productsManager->getListOfProducts($apiHelperDouble, $dataValidator, $dummyLogger);

        $this->assertCount(5, $actualRecordsArray);

    }

    /**
     * @dataProvider apiReturnDataProviderArrayCountSeven
     * @param $returnJSON
     */
    public function testAPIHelper_withUsingMock($returnJSON) {

        $apiHelperDouble = $this->getMockBuilder(ApiHelper::class)
            ->setMethodsExcept(['callAPI'])
            ->getMock();

        // FAKE
        $apiHelperDouble->method('callAPI')
            ->will($this->returnCallback(
                function () use ($returnJSON) {
                    return $returnJSON;
                }
            ));

        // MOCK
        $apiHelperDouble->expects($this->atLeastOnce())->method('callAPI');

        $dataValidator = new ApiDataValidator();

        // DUMMY
        $dummyLogger = $this->createMock(Logger::class);

        $productsManager = new ProductsManager();
        $actualRecordsArray = $productsManager->getListOfProducts($apiHelperDouble, $dataValidator, $dummyLogger);
        $this->assertIsArray($actualRecordsArray);

    }

    /**
     * @dataProvider apiReturnDataProviderArrayCountSeven
     * @param $returnJSON
     */
    public function testApiDataValidator_withUsingMock($returnJSON) {
        $apiHelperDouble = $this->getMockBuilder(ApiHelper::class)
            ->setMethodsExcept(['callAPI'])
            ->getMock();

        // STUB
        $apiHelperDouble->method('callAPI')->willReturn($returnJSON);

        $dataValidatorDouble = $this->getMockBuilder(ApiDataValidator::class)->getMock();

        // FAKE
        $dataValidatorDouble->method('validateApiResult')
            ->will($this->returnCallback(
                function () {
                    return array('products' => array("Test"));
                }
            ));

        // MOCK
        $dataValidatorDouble->expects($this->atLeastOnce())->method('validateApiResult');

        $productsManager = new ProductsManager();

        // DUMMY
        $dummyLogger = $this->createMock(Logger::class);

        $actualRecordsArray = $productsManager->getListOfProducts($apiHelperDouble, $dataValidatorDouble, $dummyLogger);
        $this->assertIsArray($actualRecordsArray);

    }

    public function testGetListOfProducts_missingAllParams() {
        $this->expectException(ArgumentCountError::class);

        $productsManager = new ProductsManager();
        $productsManager->getProductDetail();
    }

    public function testApiHelper_returnsString() {

        $apiHelper = new ApiHelper();
        $result = $apiHelper->callAPI("GET", $_ENV['API_URL_GET_ALL'], false);
        $this->assertIsString($result);

    }

    // This is more like a functional test, as it calls the real API...
    /**
     * @dataProvider apiReturnNonExistingURL
     * @param $method
     * @param $url
     * @param $data
     */
    public function testApiHelper_withInvalidRequestUrl($method, $url, $data) {

        $apiHelper = new ApiHelper();
        $result = $apiHelper->callAPI($method, $url, $data);
        $this->assertIsString($result);
        $this->assertStringContainsString("Whoops, looks like something went wrong.", $result);

    }

    /**
     * @dataProvider apiReturnDataProviderArrayCountSeven
     * @param $returnJSON
     */
    public function testApiDataValidator_withUsingSPY($returnJSON) {
        $apiHelperDouble = $this->getMockBuilder(ApiHelper::class)
            ->setMethodsExcept(['callAPI'])
            ->getMock();

        // STUB
        $apiHelperDouble->method('callAPI')->willReturn($returnJSON);

        $dataValidatorDouble = $this->getMockBuilder(ApiDataValidator::class)->getMock();

        // FAKE
        $dataValidatorDouble->method('validateApiResult')
            ->will($this->returnCallback(
                function () {
                    return array('products' => array("Test"));
                }
            ));

        // SPY
        $dataValidatorDouble->expects($spy = $this->any())->method('validateApiResult');

        $productsManager = new ProductsManager();

        // DUMMY
        $dummyLogger = $this->createMock(Logger::class);

        $actualRecordsArray = $productsManager->getListOfProducts($apiHelperDouble, $dataValidatorDouble, $dummyLogger);
        $this->assertIsArray($actualRecordsArray);

        // Verify
        $invocations = $spy->getInvocations();

        $this->assertGreaterThan(0, $invocations);
        $firstParameter = $invocations[0]->getParameters()[0];
        $this->assertIsString($firstParameter);

    }

    public function apiReturnDataProviderArrayCountFive()
    {
        $returnJSON5 = '{"products":{"combgap":"Combined GAP","smart":"SMART","annualtravel":"Annual Multi-Trip Travel Insurance","singletravel":"Single-Trip Travel Insurance","buildcont":"Buildings & Contents Insurance"}}';

        return [[$returnJSON5]];
    }

    public function apiReturnDataProviderArrayCountSeven()
    {
        $returnJSON7 = '{"products":{"combgap":"Combined GAP","smart":"SMART","annualtravel":"Annual Multi-Trip Travel Insurance","singletravel":"Single-Trip Travel Insurance","buildcont":"Buildings & Contents Insurance","income":"Income Protection","car":"Car Insurance"}}';

        return [[$returnJSON7]];
    }

    public function apiReturnNonExistingURL()
    {

        return [["GET", "https://www.itccompliance.co.uk/recruitment-webservice/api/oliver", false]];
    }
}