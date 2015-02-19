import requests, simplejson, urllib
import random


shipments= [{
	"waybill":"1111111111", # waybill number
        "name": "Rohan Gothwal", 
        "order": "32423424", # order number unique
        "products_desc": "Sony PS3 Super Slim 500 GB (Black)",
        "order_date": "2014-05-08T12:30:00+00:00",
        "payment_mode": "Pre-paid",
        "total_amount": 21841.0,
        "cod_amount": 0.0,
        "add": "M25, Nelson Marg, GBP City Phase 1",
        "city": "Gurgaon",
        "state": "Haryana",
        "country": "India",
        "phone": "9741119727",
        "pin": "122002",
        "return_add": "",
        "return_city": "",
        "return_country": "",
        "return_name": "",
        "return_phone": "",
        "return_pin": "",
        "return_state": "",
        "supplier": "Kangaroo (India) Pvt Ltd",
        "billable_weight": 650.0,
        "dimensions": "0.00CM x 0.00CM x 0.00CM",
        "volumetric": 0.0,
        "weight": "650.0 gm",
	"product_quantity": 1, # quantity of goods, positive integer
	"seller_inv": "invoice number",
	"seller_inv_date": 'YYYY-MM-DDTHH:MM:SS+05:30', # ISO format
	"seller_name": "seller name", # name of seller
	"seller_add": "seller add", # seller address
	"seller_cst": "seller cst", # seller cst no
	"seller_tin": "seller tin", # seller tin no

}
        ]
token="xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
url = "http://test.delhivery.com/cmu/push/json/?token={}".format(token)
r = requests.post(url, data=urllib.urlencode(
    {
        "data":simplejson.dumps(
            {
                "dispatch_date": "2014-05-08T18:00:00.000000+05:30",
                "shipments": shipments,
            }
        ),
        "format": "json"
    }), headers = {"content-type": "application/x-www-form-urlencoded"})
print r

