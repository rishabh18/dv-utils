String url="http://test.delhivery.com/api/p/createOrder/xml/"
String key="87t87t8jkjkgjkjg"
HttpClient client = new HttpClient();
PostMethod method = new PostMethod(url);
String payload ="""
<?xml version="1.0" encoding="UTF8"?>
<transaction>
<customerDetails>
<address>test address</address>
<contactNo>1234567890</contactNo>
<email>naresh+90@thinkvidya.com</email>
<firstName>naresh</firstName>
<lastName>nasireddi</lastName>
<prefix>Mr.</prefix>
</customerDetails>
<orderDetails>
<pincode>560034</pincode>
<clientOrderID>36996566</clientOrderID>
<deliveryDate>20082013
</deliveryDate>
<orderAmount>1000</orderAmount>
<clientComments></clientComments>
<paymentMode>cash</paymentMode>
<productDetails>
<productID>1</productID>
<productQuantity>1</productQuantity>
<productDescription>test</productDescription>
</productDetails>
<templateID>1</templateID>
<InvoiceUrl></InvoiceUrl>
</orderDetails>
<additionalInformation>
<parameters>
<name></name>
<value></value>
</parameters>
<parameters>
<name></name>
<value></value>
</parameters>
</additionalInformation>
</transaction>
"""
payload = payload.trim()
log.info("Sending request: ${payload}");
payload = payload.trim()
method.addRequestHeader("Accept","application/xml")
NameValuePair[] postData = {
new NameValuePair("data",payload)
}
NameValuePair getData =new NameValuePair("token",key)
//for passing get parameters
method.setQueryString(getData)
//for passing post parameters
method.setRequestBody(postData)
String statusCode = client.executeMethod(method)
log.info("Gharpay status code returned: ${statusCode}");
String resultsString = method.getResponseBodyAsString()
log.info("Gharpay response: ${resultsString}");
method.releaseConnection();
