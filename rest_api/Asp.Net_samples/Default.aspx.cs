using System;

using System.Collections.Generic;

using System.IO;

using System.Linq;

using System.Net;

using System.Text;

using System.Web;

using System.Web.UI;

using System.Web.UI.WebControls;

using Newtonsoft;

using Newtonsoft.Json;

using Newtonsoft.Json.Serialization;

using Newtonsoft.Json.Converters;



public partial class _Default : System.Web.UI.Page

{

    protected void Page_Load(object sender, EventArgs e)

    {

        string HTSMSURL = "http://test.delhivery.com/cmu/push/json/?token=xxxxxxxxxxxxxxxxxxxxxxxxxxxx";

        // replace xxxxxxxxxx with your token



       // StreamReader reader = new StreamReader(@"c:\json.txt");

        StreamReader reader = new StreamReader(Server.MapPath("~/App_Data/json.txt"));



        string msg = reader.ReadToEnd();

        reader.Dispose();



        string test = JsonConvert.SerializeObject(msg);



        Uri smsUri = new Uri(HTSMSURL);

        // Initializes a new instance of the System.Uri class with the specified URI.

        byte[] postBytes = Encoding.ASCII.GetBytes(msg);

        HttpWebRequest HttpWReq = (HttpWebRequest)WebRequest.Create(smsUri);



        HttpWReq.KeepAlive = false;

        HttpWReq.ProtocolVersion = HttpVersion.Version11;

        HttpWReq.Method = "POST";

        HttpWReq.ContentType = "application/x-www-form-urlencoded; charset=UTF-8";

        HttpWReq.Accept = "application/json";

        HttpWReq.ContentLength = postBytes.Length;

        Stream requestStream = HttpWReq.GetRequestStream();

        requestStream.Write(postBytes, 0, postBytes.Length);



        using (HttpWebResponse HttpWResp = (HttpWebResponse)HttpWReq.GetResponse())

        {

            using (var streamReader = new StreamReader(HttpWResp.GetResponseStream()))

            {

                var result = streamReader.ReadToEnd();

                lbl.Text = result;

            }

        }

        

    }



    public class data

    {

        public List<shipments> myShipment { get; set; }

    }



    public class shipments

    {

        public string client { get; set; }

        public string name { get; set; }

        public string order { get; set; }

        public string products_desc { get; set; }

        public string order_date { get; set; }

        public string payment_mode { get; set; }

        public string total_amount { get; set; }

        public string cod_amount { get; set; }

        public string add { get; set; }

        public string city { get; set; }

        public string state { get; set; }

        public string country { get; set; }

        public string phone { get; set; }

        public string pin { get; set; }

    }

    //public class HTResponse

    //{

    //    public string status { get; set; }

    //    public List<Number> message { get; set; }

    //}



    //public class Number

    //{

    //    public string Id { get; set; }

    //}



}
