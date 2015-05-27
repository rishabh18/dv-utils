'use strict';

var url = require('url');
var request = require('request');

var jsonCreatePackageData = function(){
  var package_shipments = [];
  package_shipments.push({
    "waybill": 'xxxxxxxxx',
    "name": 'John Kapoor',
    "order": '3002199823224D'
    "payment_mode":'cash',
    "order_date":'2013-04-08T18:30:00+00:00',
    "phone":'9741119727',
    "products_desc": 'Resume services',
    "quantity":1,
    "total_amount":21841.0,
    "cod_amount": 21841.0,
    "add":'M25, Nelson Marg, GBP City Phase 1',
    "state":'Haryana',
    "city":'Gurgaon',
    "pin":122002,
    "country":"India",
    "seller_name": 'seller',
    "seller_add": 'add of seller',
    "seller_inv": 'invoice_number',
    "seller_tin": 'tin no',
    "seller_cst": 'cst no',
    "seller_inv_date": '2013-04-08T18:30:00+00:00'
  });
  var create_packagedata = {
    "data":{
      "shipments": package_shipments,
      "pickup_location":{
        "name":'client location',
        "add":'A-109, Amar Colony',
        "state":'Delhi',
        "city":'New Delhi',
        "pin":110070,
        "country":"India",
        "phone": '011-23456245'
      },
    },
    "format":"json"
  }
  return JSON.stringify(create_packagedata);
};


// push order
exports.shipment = function(req, res, next) {
    var TOKEN = req.session.token;
    var URL = 'http://test.delhivery.com/cmu/push/json/?token=' + TOKEN,

    // var data = req.body
    var data = jsonCreatePackageData();

    var options = {
        url: URL,
        method: 'POST',
        form: serialize(data),
        headers: {
          'content-type': 'application/x-www-form-urlencoded',
        }
    };

    var url_data = Object.keys(data).map(function(k) {
            return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
        }).join('&')
    logger.info(URL +'?'+url_data)


    // callback function after api-request
    function callback(error, response, body) {
        // on success
        if (!error && response.statusCode === 200) {
            var info = JSON.parse(body);
            res.json(info);
        }
        // on error
        else if (error) {
            console.log('error', error);
            res.json(400, {
                message: error
            });
        }
        // other cases
        else {
            console.log('other', response.toJSON());
            res.json(400, {
                message: "Unable to connect to REST server " + config.restbe.host
            });
        }
    }
    // call the server passing options and a callback
    request(options, callback);
};
