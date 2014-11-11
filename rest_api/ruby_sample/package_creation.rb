require 'uri'
#=> true
require 'net/http'
#=> true
data = {"shipments"=>[{"name"=>"Williams", "order"=>"REFNUM67855", "products_desc"=>"Order Description", "order_date"=>"2014-04-24 18:43:01 +0530", "payment_mode"=>"Cash", "total_amount"=>500, "cod_amount"=>500, "add"=>"1st Floor,plot no 82,sector 44,Gurgaon(HARYANA) 200332", "city"=>"Gurgaon", "state"=>"Gurgaon", "country"=>"india", "phone"=>"9145345544", "pin"=>"400064"}], "pickup_location"=>{"add"=>"Vendor address, area, city,pincode", "city"=>"Gurgaon", "country"=>"India", "name"=>"warehouse_name", "phone"=>"0141-2353333 ", "pin"=>"343243", "state"=>"Maharashtra"}}
#=> {"shipments"=>[{"name"=>"Williams", "order"=>"REFNUM67855", "products_desc"=>"Order Description", "order_date"=>"2014-04-24 18:43:01 +0530", "payment_mode"=>"Cash", "total_amount"=>500, "cod_amount"=>500, "add"=>"1st Floor,plot no 82,sector 44,Gurgaon(HARYANA) 200332", "city"=>"Gurgaon", "state"=>"Gurgaon", "country"=>"india", "phone"=>"9145345544", "pin"=>"400064"}], "pickup_location"=>{"add"=>"Vendor address, area, city,pincode", "city"=>"Gurgaon", "country"=>"India", "name"=>"warehouse_name", "phone"=>"0141-2353333 ", "pin"=>"343243", "state"=>"Maharashtra"}}
url = "http://test.delhivery.com/cmu/push/json/?token=xxxxxxxxxxxxxxxxxxxxxxxxxxx"
#=> "http://test.delhivery.com/cmu/push/json/?token=xxxxxxxxxxxxxxxxxxxxxxxxxxxx"
uri = URI.parse(url)
#=> #<URI::HTTP:0x000000022f04e8 URL:http://test.delhivery.com/cmu/push/json/?token=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx>
uri = URI.parse(url)
#=> #<URI::HTTP:0x000000022e6ce0 URL:http://test.delhivery.com/cmu/push/json/?token=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx>
http = Net::HTTP.new(uri.host, uri.port)
#=> #<Net::HTTP test.delhivery.com:80 open=false>
req = Net::HTTP::Post.new(uri.request_uri)
#=> #<Net::HTTP::Post POST>
req.add_field("content-type", "application/x-www-form-urlencoded")
#=> ["application/x-www-form-urlencoded"]
require 'json'
#=> true
req.set_form_data({'data'=>data.to_json, 'format'=>'json'})
#=> "application/x-www-form-urlencoded"
req.add_field("content-type", "application/x-www-form-urlencoded")
#=> ["application/x-www-form-urlencoded", "application/x-www-form-urlencoded"]
response = http.request(req)
#=> #<Net::HTTPOK 200 OK readbody=true>
JSON.parse(response.body)
irb(main):021:0>     JSON.parse(response.body)
#=> {"cash_pickups_count"=>1.0, "cod_count"=>0, "success"=>true, "package_count"=>1, "upload_wbn"=>"UPL22032322", "replacement_count"=>0, "cod_amount"=>0.0, "prepaid_count"=>0, "pickups_count"=>0, "packages"=>[{"status"=>"Success", "waybill"=>"34234235432534", "refnum"=>"REFNUM67855", "client"=>"ClientName", "remarks"=>"", "cod_amount"=>500, "payment"=>"Cash"}], "cash_pickups"=>500}

