In order to Test Delhivery's api, you may use the request files in this directory
and create a request using curl-

example-

curl --data-binary @createOrder test.delhivery.com/services/api/soap/

curl --data-binary @viewOrderDetails test.delhivery.com/services/api/soap/

curl --data-binary @viewOrderStatus test.delhivery.com/services/api/soap/

curl --data-binary @getAllPincodes test.delhivery.com/services/api/soap/

curl --data-binary @isPincodePresent test.delhivery.com/services/api/soap/
