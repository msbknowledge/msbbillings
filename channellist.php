<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$json='[
    {
        "genre_id_a": "1",
        "gen_name_a": "ENTERTAINMENT",
        "ch_list": [
            {
                "c_code": "1",
                "c_name": "STAR JALSHA",
                "c_lcn": "1",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1.jpg"
            },
            {
                "c_code": "2",
                "c_name": "ZEE BANGLA",
                "c_lcn": "2",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566205400ZEE_BANGLA.png"
            },
            {
                "c_code": "3",
                "c_name": "COLORS BANGLA",
                "c_lcn": "3",
                "a_price": "7",
                "is_logo": "1",
                "logo_name": "1566209178COLORS_BANGLA.jpg"
            },
            {
                "c_code": "4",
                "c_name": "SUN BANGLA",
                "c_lcn": "4",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566206829sun_bangla.png"
            },
            {
                "c_code": "5",
                "c_name": "SONY AATH",
                "c_lcn": "5",
                "a_price": "4",
                "is_logo": "1",
                "logo_name": "1566206449SONY_AATH.png"
            },
            {
                "c_code": "7",
                "c_name": "ONE SHOPPE",
                "c_lcn": "7",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570880609One_Shopping_Logo_Final.png"
            },
            {
                "c_code": "8",
                "c_name": "ORANGE TV",
                "c_lcn": "8",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570880701Orange_Bangla.png"
            },
            {
                "c_code": "9",
                "c_name": "CTVN",
                "c_lcn": "9",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566207318images.jpg"
            },
            {
                "c_code": "10",
                "c_name": "ONE",
                "c_lcn": "11",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570880525One_Logo.png"
            },
            {
                "c_code": "11",
                "c_name": "ONE BAZAR",
                "c_lcn": "12",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570880502ONE_BAZAAR_LOGO.png"
            },
            {
                "c_code": "12",
                "c_name": "AAKASH AATH",
                "c_lcn": "13",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566207535AAKASH_AATH.png"
            },
            {
                "c_code": "14",
                "c_name": "SONAR BANGLA",
                "c_lcn": "17",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566208326sonarbangla.jpg"
            },
            {
                "c_code": "15",
                "c_name": "SRISTI TV",
                "c_lcn": "18",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566385568sristi_tv.png"
            },
            {
                "c_code": "16",
                "c_name": "CHANNEL VISION",
                "c_lcn": "19",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566292346channel_vision.png"
            },
            {
                "c_code": "17",
                "c_name": "SRISTI TV PLUS",
                "c_lcn": "22",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566208784sristi_plus.png"
            },
            {
                "c_code": "18",
                "c_name": "ONE SADHANA",
                "c_lcn": "23",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570880584One_Sadhana_Logo.png"
            },
            {
                "c_code": "19",
                "c_name": "SHREE BANGLA",
                "c_lcn": "24",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566209512shree_bangla.jpg"
            },
            {
                "c_code": "20",
                "c_name": "CTN TV",
                "c_lcn": "25",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566385332ctn_tvv.png"
            },
            {
                "c_code": "22",
                "c_name": "GLOBE TV",
                "c_lcn": "28",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566385420glob_tv.png"
            },
            {
                "c_code": "23",
                "c_name": "BENGAL FACE",
                "c_lcn": "31",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1580589099bengal_face.png"
            },
            {
                "c_code": "24",
                "c_name": "AMAR CHANNEL",
                "c_lcn": "32",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570878461AMAR_CHANNEL.png"
            },
            {
                "c_code": "25",
                "c_name": "RUPOSHI BANGLA",
                "c_lcn": "33",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566210828RUPASHI_BANGLA.png"
            },
            {
                "c_code": "26",
                "c_name": "DD BANGLA",
                "c_lcn": "34",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566211546DD_BANGLA.png"
            },
            {
                "c_code": "27",
                "c_name": "STAR JALSHA HD",
                "c_lcn": "35",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566211956STAR_JALSA_HD.png"
            },
            {
                "c_code": "28",
                "c_name": "ZEE BANGLA HD",
                "c_lcn": "36",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566213419ZEE_BANGLA_HD.jpg"
            },
            {
                "c_code": "29",
                "c_name": "COLORS BANGLA HD",
                "c_lcn": "37",
                "a_price": "14",
                "is_logo": "1",
                "logo_name": "1570878762Colors_Bangla_HD.png"
            },
            {
                "c_code": "59",
                "c_name": "STAR PLUS",
                "c_lcn": "100",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566286198STAR_PLUS.png"
            },
            {
                "c_code": "60",
                "c_name": "SET",
                "c_lcn": "101",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566286372SET.png"
            },
            {
                "c_code": "61",
                "c_name": "COLORS",
                "c_lcn": "102",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566286525COLORS.png"
            },
            {
                "c_code": "62",
                "c_name": "ZEE TV",
                "c_lcn": "121",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566286632ZEE_TV.png"
            },
            {
                "c_code": "63",
                "c_name": "SAB",
                "c_lcn": "104",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566286744SAB.png"
            },
            {
                "c_code": "64",
                "c_name": "STAR BHARAT",
                "c_lcn": "105",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566286964STAR_BHARAT.png"
            },
            {
                "c_code": "65",
                "c_name": "&TV",
                "c_lcn": "122",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566287071TV.png"
            },
            {
                "c_code": "66",
                "c_name": "BIG MAGIC",
                "c_lcn": "127",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566287172BIG_MAGIC.png"
            },
            {
                "c_code": "67",
                "c_name": "PAL",
                "c_lcn": "108",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566287336PAL.png"
            },
            {
                "c_code": "68",
                "c_name": "COLORS RISHTEY",
                "c_lcn": "110",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566287482COLORS_RISHTEY.png"
            },
            {
                "c_code": "69",
                "c_name": "ZEE ANMOL",
                "c_lcn": "128",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566287593ZEE_ANMOL.png"
            },
            {
                "c_code": "70",
                "c_name": "STAR UTSAV",
                "c_lcn": "113",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566287894STAR_UTSAV.png"
            },
            {
                "c_code": "71",
                "c_name": "INVESTIGATION DISCOVERY",
                "c_lcn": "114",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1580589433id.png"
            },
            {
                "c_code": "73",
                "c_name": "BINDASS",
                "c_lcn": "117",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566294504BINDASS.png"
            },
            {
                "c_code": "74",
                "c_name": "NAAPTOL",
                "c_lcn": "123",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1574079044naaptol-378x213.png"
            },
            {
                "c_code": "75",
                "c_name": "DD NATIONAL",
                "c_lcn": "131",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566294721DD_NATIONAL.png"
            },
            {
                "c_code": "76",
                "c_name": "DD UP",
                "c_lcn": "132",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566294821DD_UPp.png"
            },
            {
                "c_code": "77",
                "c_name": "DD MADHYA PRADESH",
                "c_lcn": "133",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566294967DD_MP.png"
            },
            {
                "c_code": "78",
                "c_name": "STAR PLUS HD",
                "c_lcn": "135",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566295225STAR_PLUS_HD.png"
            },
            {
                "c_code": "79",
                "c_name": "COLORS HD",
                "c_lcn": "136",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566295330COLORS_HD.png"
            },
            {
                "c_code": "80",
                "c_name": "SET HD",
                "c_lcn": "137",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566296000SET_HD.png"
            },
            {
                "c_code": "81",
                "c_name": "ZEE TV HD",
                "c_lcn": "138",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566296359ZEE_TV_HD.png"
            },
            {
                "c_code": "82",
                "c_name": "SAB HD",
                "c_lcn": "139",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566296729SAB_HD.png"
            },
            {
                "c_code": "83",
                "c_name": "STAR BHARAT HD",
                "c_lcn": "140",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566297034STAR_BHARAT_HD.png"
            },
            {
                "c_code": "84",
                "c_name": "&TV HD",
                "c_lcn": "141",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566298817TV_HD.png"
            },
            {
                "c_code": "85",
                "c_name": "INVESTIGATION DISCOVERY HD",
                "c_lcn": "142",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1580708111id_hd.png"
            },
            {
                "c_code": "216",
                "c_name": "STAR WORLD",
                "c_lcn": "375",
                "a_price": "8",
                "is_logo": "1",
                "logo_name": "1566471964STAR_WORLD.png"
            },
            {
                "c_code": "217",
                "c_name": "COMEDY CENTRAL",
                "c_lcn": "376",
                "a_price": "5",
                "is_logo": "1",
                "logo_name": "1566472081COMEDY_CENTRAL.png"
            },
            {
                "c_code": "218",
                "c_name": "ZEE CAF\u00c9",
                "c_lcn": "378",
                "a_price": "15",
                "is_logo": "1",
                "logo_name": "1570881437zee_cafe_logo.png"
            },
            {
                "c_code": "220",
                "c_name": "COLORS INFINITY",
                "c_lcn": "384",
                "a_price": "5",
                "is_logo": "1",
                "logo_name": "1566472484COLORS_INFINITY.png"
            },
            {
                "c_code": "221",
                "c_name": "STAR WORLD HD",
                "c_lcn": "390",
                "a_price": "9",
                "is_logo": "1",
                "logo_name": "1566472636STAR_WORLD_HD.png"
            },
            {
                "c_code": "222",
                "c_name": "COMEDY CENTRAL HD",
                "c_lcn": "391",
                "a_price": "9",
                "is_logo": "1",
                "logo_name": "1566472779COMEDY_CENTRAL_HD.png"
            },
            {
                "c_code": "223",
                "c_name": "ZEE CAF\u00c9 HD",
                "c_lcn": "392",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566472941ZEE_CAFE_HD.png"
            },
            {
                "c_code": "225",
                "c_name": "COLORS INFINITY HD",
                "c_lcn": "394",
                "a_price": "9",
                "is_logo": "1",
                "logo_name": "1566473177COLORS_INFINITY_HD.png"
            },
            {
                "c_code": "226",
                "c_name": "STAR WORLD PREMIERE HD",
                "c_lcn": "395",
                "a_price": "9",
                "is_logo": "1",
                "logo_name": "1566473269STAR_WORLD_PREMIER_HD.png"
            },
            {
                "c_code": "227",
                "c_name": "DISNEY INTERNATIONAL HD",
                "c_lcn": "396",
                "a_price": "15",
                "is_logo": "1",
                "logo_name": "1566473384DISNEY_INTERNATIONAL_HD.png"
            },
            {
                "c_code": "288",
                "c_name": "DD NORTH EAST",
                "c_lcn": "650",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570885352DD_ne.png"
            },
            {
                "c_code": "289",
                "c_name": "RANG TV",
                "c_lcn": "651",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566482138RANG.png"
            },
            {
                "c_code": "290",
                "c_name": "DD ARUNPRABHA",
                "c_lcn": "652",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566481756DD_ARUNPRABHA.png"
            },
            {
                "c_code": "295",
                "c_name": "DD BIHAR",
                "c_lcn": "675",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566481262DD_BIHAR.png"
            },
            {
                "c_code": "296",
                "c_name": "BIG GANGA",
                "c_lcn": "676",
                "a_price": "0.5",
                "is_logo": "1",
                "logo_name": "1566481181BIG_GANGA.png"
            },
            {
                "c_code": "302",
                "c_name": "ANJAN TV",
                "c_lcn": "684",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566479358ANJAN_TV.png"
            },
            {
                "c_code": "307",
                "c_name": "TARANG",
                "c_lcn": "700",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566478807TARANG.png"
            },
            {
                "c_code": "308",
                "c_name": "ZEE SARTHAK",
                "c_lcn": "701",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566478683ZEE_SARTHAK.png"
            },
            {
                "c_code": "309",
                "c_name": "COLORS ORIYA",
                "c_lcn": "702",
                "a_price": "6",
                "is_logo": "1",
                "logo_name": "1566478577COLORS_ODIA.png"
            },
            {
                "c_code": "310",
                "c_name": "ALANKAR",
                "c_lcn": "703",
                "a_price": "4",
                "is_logo": "1",
                "logo_name": "1566478365ALANKAR.png"
            },
            {
                "c_code": "311",
                "c_name": "DD ORIYA",
                "c_lcn": "713",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566478225DD_ORIYA.png"
            },
            {
                "c_code": "324",
                "c_name": "DD PUNJABI",
                "c_lcn": "738",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566466064DD_PUNJABI.png"
            },
            {
                "c_code": "328",
                "c_name": "DD SAPTAGIRI",
                "c_lcn": "750",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566465360DD_SAPTAGIRI.png"
            },
            {
                "c_code": "329",
                "c_name": "ETV",
                "c_lcn": "751",
                "a_price": "17",
                "is_logo": "1",
                "logo_name": "1566465252ETV.png"
            },
            {
                "c_code": "330",
                "c_name": "GEMINI LIFE",
                "c_lcn": "752",
                "a_price": "5",
                "is_logo": "1",
                "logo_name": "1566465019GEMINI_LIFE.png"
            },
            {
                "c_code": "331",
                "c_name": "MAA TV",
                "c_lcn": "753",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566464926MAA_TV.png"
            },
            {
                "c_code": "332",
                "c_name": "GEMINI TV",
                "c_lcn": "754",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566464828GEMINI_TV.png"
            },
            {
                "c_code": "333",
                "c_name": "MAA GOLD",
                "c_lcn": "755",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1570884408Maa_Gold.png"
            },
            {
                "c_code": "334",
                "c_name": "ZEE TELUGU",
                "c_lcn": "757",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566464651ZEE_TELEGU.png"
            },
            {
                "c_code": "338",
                "c_name": "GEMINI COMEDY",
                "c_lcn": "761",
                "a_price": "5",
                "is_logo": "1",
                "logo_name": "1566389855GEMINI_COMEDY.png"
            },
            {
                "c_code": "347",
                "c_name": "DD PODHIGAI",
                "c_lcn": "775",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566388879DD_PODHIGAIi.png"
            },
            {
                "c_code": "348",
                "c_name": "SUN TV",
                "c_lcn": "777",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566388718SUN_TV.png"
            },
            {
                "c_code": "349",
                "c_name": "SUN LIFE",
                "c_lcn": "778",
                "a_price": "9",
                "is_logo": "1",
                "logo_name": "1566388616SUN_LIFE.png"
            },
            {
                "c_code": "350",
                "c_name": "KALAIGNAR TV",
                "c_lcn": "779",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566388387KALAIGNAR_TV.png"
            },
            {
                "c_code": "351",
                "c_name": "ADITHYA TV",
                "c_lcn": "780",
                "a_price": "9",
                "is_logo": "1",
                "logo_name": "1566388304ADITHYA.png"
            },
            {
                "c_code": "352",
                "c_name": "KTV",
                "c_lcn": "781",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566388195K_TV.png"
            },
            {
                "c_code": "357",
                "c_name": "UDAYA TV",
                "c_lcn": "802",
                "a_price": "17",
                "is_logo": "1",
                "logo_name": "1566387167UDAYA_TV.png"
            },
            {
                "c_code": "358",
                "c_name": "DD CHANDANA",
                "c_lcn": "803",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566387043DD_CHANDANA.png"
            },
            {
                "c_code": "359",
                "c_name": "STAR SUVARNA",
                "c_lcn": "804",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566386919STAR_SUVARNA.png"
            },
            {
                "c_code": "360",
                "c_name": "KASTURI NEWS",
                "c_lcn": "805",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566386850KASTHURI.png"
            },
            {
                "c_code": "362",
                "c_name": "UDAYA COMEDY",
                "c_lcn": "807",
                "a_price": "6",
                "is_logo": "1",
                "logo_name": "1566386621UDAYA_COMEDY.png"
            },
            {
                "c_code": "363",
                "c_name": "SUVARNA PLUS",
                "c_lcn": "808",
                "a_price": "5",
                "is_logo": "1",
                "logo_name": "1566386533SUVARNA_PLUS.png"
            },
            {
                "c_code": "367",
                "c_name": "ASIANET",
                "c_lcn": "825",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566386063ASIANET.png"
            },
            {
                "c_code": "368",
                "c_name": "SURYA TV",
                "c_lcn": "826",
                "a_price": "12",
                "is_logo": "1",
                "logo_name": "1566385964SURYA_TV.png"
            },
            {
                "c_code": "369",
                "c_name": "ZEE KERALAM",
                "c_lcn": "827",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566385867ZEE_KERALAM.png"
            },
            {
                "c_code": "370",
                "c_name": "DD MALAYALAM",
                "c_lcn": "828",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566385790DD_MALYALAM.png"
            },
            {
                "c_code": "371",
                "c_name": "ASIANET PLUS",
                "c_lcn": "829",
                "a_price": "5",
                "is_logo": "1",
                "logo_name": "1566381255ASIANET_PLUS.png"
            },
            {
                "c_code": "372",
                "c_name": "KAIRALI TV",
                "c_lcn": "830",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566381167KAIRALI_TV.png"
            },
            {
                "c_code": "375",
                "c_name": "SURYA COMEDY",
                "c_lcn": "835",
                "a_price": "4",
                "is_logo": "1",
                "logo_name": "1566380402SURYA_COMEDY.png"
            },
            {
                "c_code": "378",
                "c_name": "KOCHU TV",
                "c_lcn": "847",
                "a_price": "5",
                "is_logo": "1",
                "logo_name": "1566379984KOCHU_TV.png"
            },
            {
                "c_code": "379",
                "c_name": "COLORS GUJARATI",
                "c_lcn": "850",
                "a_price": "5",
                "is_logo": "1",
                "logo_name": "1566379851COLORS_GUJARATI.png"
            },
            {
                "c_code": "381",
                "c_name": "GTPL GUJARATI",
                "c_lcn": "852",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566379611GTPL_GUJRATI.png"
            },
            {
                "c_code": "390",
                "c_name": "DD RAJASTHAN",
                "c_lcn": "868",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566378683DD_RAJASTHAN.png"
            },
            {
                "c_code": "391",
                "c_name": "24 HOURS TV",
                "c_lcn": "875",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "157087789424_hours_tv.png"
            },
            {
                "c_code": "397",
                "c_name": "STAR PRAVAH",
                "c_lcn": "908",
                "a_price": "9",
                "is_logo": "1",
                "logo_name": "1566370977STAR_PRABHA.png"
            },
            {
                "c_code": "398",
                "c_name": "SONY MARATHI",
                "c_lcn": "909",
                "a_price": "4",
                "is_logo": "1",
                "logo_name": "1566370818SONY_MARATHI.png"
            },
            {
                "c_code": "399",
                "c_name": "COLORS MARATHI",
                "c_lcn": "910",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566370688COLORS_MARATHI.png"
            },
            {
                "c_code": "400",
                "c_name": "ZEE MARATHI",
                "c_lcn": "911",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566370566ZEE_MARATHI.png"
            },
            {
                "c_code": "402",
                "c_name": "ZEE YUVA",
                "c_lcn": "913",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566370196ZEE_YUVA.png"
            },
            {
                "c_code": "403",
                "c_name": "DD SAHYADRI",
                "c_lcn": "914",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566370082DD_SAHYADRI.png"
            },
            {
                "c_code": "404",
                "c_name": "DD KASHIR",
                "c_lcn": "915",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566369872DD_KASHIR.png"
            },
            {
                "c_code": "405",
                "c_name": "ZEE TALKIES",
                "c_lcn": "916",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1566369726ZEE_TALKIES.png"
            },
            {
                "c_code": "413",
                "c_name": "HTV",
                "c_lcn": "959",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570887736Home_tv.png"
            },
            {
                "c_code": "415",
                "c_name": "ENTER 10 BANGLA",
                "c_lcn": "10",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566368418ENTER_10_BANGLA.png"
            },
            {
                "c_code": "420",
                "c_name": "DEB TV",
                "c_lcn": "29",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570878916Deb_Tv.png"
            },
            {
                "c_code": "434",
                "c_name": "DD YADAGIRI",
                "c_lcn": "756",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1578115515DD_Yadagiri.png"
            },
            {
                "c_code": "442",
                "c_name": "STAR GEC PROMO ENGLISH",
                "c_lcn": "385",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1587725364kisspng-star-plus-star-india-television-show-television-ch-net-5b101d32dc6182_6265401415277827069027.png"
            },
            {
                "c_code": "443",
                "c_name": "DD RETRO",
                "c_lcn": "134",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1589771940DD-Retro.png"
            },
            {
                "c_code": "444",
                "c_name": "SHEMAROO TV",
                "c_lcn": "116",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1594883861index.png"
            }
        ],
        "ch_qt": "121"
    },
    {
        "genre_id_a": "2",
        "gen_name_a": "KIDS",
        "ch_list": [
            {
                "c_code": "13",
                "c_name": "RONGEEN TV",
                "c_lcn": "14",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566207985rongegntv.png"
            },
            {
                "c_code": "170",
                "c_name": "POGO",
                "c_lcn": "300",
                "a_price": "4.25",
                "is_logo": "1",
                "logo_name": "1566459715POGO.png"
            },
            {
                "c_code": "171",
                "c_name": "NICK",
                "c_lcn": "301",
                "a_price": "6",
                "is_logo": "1",
                "logo_name": "1566459834NICK.png"
            },
            {
                "c_code": "172",
                "c_name": "DISNEY CHANNEL",
                "c_lcn": "302",
                "a_price": "8",
                "is_logo": "1",
                "logo_name": "1566459930DISNEY_CHANNEL.png"
            },
            {
                "c_code": "173",
                "c_name": "CARTOON NETWORK",
                "c_lcn": "303",
                "a_price": "4.25",
                "is_logo": "1",
                "logo_name": "1566460052CARTOON_NETWORK.png"
            },
            {
                "c_code": "174",
                "c_name": "HUNGAMA TV",
                "c_lcn": "304",
                "a_price": "6",
                "is_logo": "1",
                "logo_name": "1566460154HUNGAMA_TV.png"
            },
            {
                "c_code": "175",
                "c_name": "DISCOVERY KIDS",
                "c_lcn": "305",
                "a_price": "3",
                "is_logo": "1",
                "logo_name": "1566460311DISCOVERY_KIDS.png"
            },
            {
                "c_code": "176",
                "c_name": "SONIC",
                "c_lcn": "306",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1566460400SONIC.png"
            },
            {
                "c_code": "177",
                "c_name": "MARVEL HQ",
                "c_lcn": "307",
                "a_price": "4",
                "is_logo": "1",
                "logo_name": "1566460526MARVEL_HQ.png"
            },
            {
                "c_code": "178",
                "c_name": "NICK JR",
                "c_lcn": "309",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566460628NICK_JUNIOR.png"
            },
            {
                "c_code": "179",
                "c_name": "DISNEY JUNIOR",
                "c_lcn": "310",
                "a_price": "4",
                "is_logo": "1",
                "logo_name": "1566460777DISNEY_JUNIOR.png"
            },
            {
                "c_code": "180",
                "c_name": "SONY YAY!",
                "c_lcn": "311",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1566460869SONY_YAY.png"
            },
            {
                "c_code": "181",
                "c_name": "NICK HD+",
                "c_lcn": "325",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566461079NICK_HD+.png"
            },
            {
                "c_code": "182",
                "c_name": "BABY TV HD",
                "c_lcn": "326",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566461194BABY_TV_ASIA_HD.png"
            },
            {
                "c_code": "183",
                "c_name": "CARTOON NETWORK HD+",
                "c_lcn": "327",
                "a_price": "5",
                "is_logo": "1",
                "logo_name": "1566461673CARTOON_NETWORK_HD+.png"
            },
            {
                "c_code": "344",
                "c_name": "KUSHI TV",
                "c_lcn": "771",
                "a_price": "4",
                "is_logo": "1",
                "logo_name": "1566389188KHUSHI_TV.png"
            },
            {
                "c_code": "356",
                "c_name": "CHUTTI TV",
                "c_lcn": "796",
                "a_price": "6",
                "is_logo": "1",
                "logo_name": "1566387268CHUTTI_TV.png"
            },
            {
                "c_code": "364",
                "c_name": "CHINTU TV",
                "c_lcn": "814",
                "a_price": "6",
                "is_logo": "1",
                "logo_name": "1566386441Chintu_TV.png"
            }
        ],
        "ch_qt": "18"
    },
    {
        "genre_id_a": "3",
        "gen_name_a": "MOVIES",
        "ch_list": [
            {
                "c_code": "30",
                "c_name": "JALSHA MOVIES",
                "c_lcn": "45",
                "a_price": "6",
                "is_logo": "1",
                "logo_name": "1566213763JALSA_MOVIES.png"
            },
            {
                "c_code": "31",
                "c_name": "ZEE BANGLA CINEMA",
                "c_lcn": "50",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1566213986ZEE_BANGLA_CINEMA.png"
            },
            {
                "c_code": "32",
                "c_name": "COLORS BANGLA CINEMA",
                "c_lcn": "47",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1570878797colors-bangla-cinema.png"
            },
            {
                "c_code": "33",
                "c_name": "ONE MOVIES",
                "c_lcn": "48",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570880556One_Movies_Logo.png"
            },
            {
                "c_code": "35",
                "c_name": "AMAR CINEMA",
                "c_lcn": "51",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570878400Amar_Cinema.png"
            },
            {
                "c_code": "36",
                "c_name": "JALSHA MOVIES HD",
                "c_lcn": "55",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566214642JALSHA_MOVIES_HD.png"
            },
            {
                "c_code": "86",
                "c_name": "STAR GOLD",
                "c_lcn": "150",
                "a_price": "8",
                "is_logo": "1",
                "logo_name": "1566298860STAR_GOLD.png"
            },
            {
                "c_code": "87",
                "c_name": "ZEE CINEMA",
                "c_lcn": "175",
                "a_price": "15",
                "is_logo": "1",
                "logo_name": "1566298892ZEE_CINEMA.png"
            },
            {
                "c_code": "88",
                "c_name": "SET MAX",
                "c_lcn": "152",
                "a_price": "15",
                "is_logo": "1",
                "logo_name": "1570880784set_max.png"
            },
            {
                "c_code": "89",
                "c_name": "STAR GOLD 2",
                "c_lcn": "154",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1581920649STAR_GOLD_2.png"
            },
            {
                "c_code": "90",
                "c_name": "&PICTURES",
                "c_lcn": "176",
                "a_price": "6",
                "is_logo": "1",
                "logo_name": "1566298958_PICTURE.png"
            },
            {
                "c_code": "91",
                "c_name": "MAX 2",
                "c_lcn": "156",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566298979MAX_2.png"
            },
            {
                "c_code": "92",
                "c_name": "COLORS CINEPLEX",
                "c_lcn": "157",
                "a_price": "3",
                "is_logo": "1",
                "logo_name": "1566298792COLORS_CINEPLEX.png"
            },
            {
                "c_code": "93",
                "c_name": "UTV MOVIES",
                "c_lcn": "158",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1566299005UTV_MOVIES.png"
            },
            {
                "c_code": "94",
                "c_name": "SONY WAH",
                "c_lcn": "160",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566299342SONY_WAH.png"
            },
            {
                "c_code": "95",
                "c_name": "UTV ACTION",
                "c_lcn": "161",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1566299429UTV_ACTION.png"
            },
            {
                "c_code": "96",
                "c_name": "STAR GOLD SELECT",
                "c_lcn": "162",
                "a_price": "7",
                "is_logo": "1",
                "logo_name": "1566299548STAR_GOLD_SELECT.png"
            },
            {
                "c_code": "97",
                "c_name": "ZEE ANMOL CINEMA",
                "c_lcn": "163",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566299649ZEE_ANMOL_CINEMA.png"
            },
            {
                "c_code": "98",
                "c_name": "STAR UTSAV MOVIES",
                "c_lcn": "164",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566299745STAR_UTSAV_MOVIES.png"
            },
            {
                "c_code": "99",
                "c_name": "WOW CINEMA ONE",
                "c_lcn": "165",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570881414Wow_Cinema_One.png"
            },
            {
                "c_code": "100",
                "c_name": "CINEMA TV INDIA",
                "c_lcn": "166",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "157407909725-Cinema_TV.png"
            },
            {
                "c_code": "101",
                "c_name": "ZEE BOLLYWOOD",
                "c_lcn": "167",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1566302053ZEE_BOLLYWOOD.png"
            },
            {
                "c_code": "102",
                "c_name": "ZEE ACTION",
                "c_lcn": "168",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566302183ZEE_ACTION.png"
            },
            {
                "c_code": "103",
                "c_name": "B4U MOVIES",
                "c_lcn": "169",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566302332B4U_MOVIES.png"
            },
            {
                "c_code": "104",
                "c_name": "B4U KADAK",
                "c_lcn": "171",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566302703B4U_KADAK.png"
            },
            {
                "c_code": "105",
                "c_name": "MAHA MOVIE",
                "c_lcn": "177",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566303114MAHA_MOVIE.png"
            },
            {
                "c_code": "106",
                "c_name": "STAR GOLD HD",
                "c_lcn": "190",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566303247STAR_GOLD_HD.png"
            },
            {
                "c_code": "107",
                "c_name": "ZEE CINEMA HD",
                "c_lcn": "191",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566303378ZEE_CINEMA_HD.png"
            },
            {
                "c_code": "108",
                "c_name": "MAX HD",
                "c_lcn": "192",
                "a_price": "17",
                "is_logo": "1",
                "logo_name": "1566303592MAX_HD.png"
            },
            {
                "c_code": "109",
                "c_name": "COLORS CINEPLEX HD",
                "c_lcn": "193",
                "a_price": "5",
                "is_logo": "1",
                "logo_name": "1566303939COLORS_CINEPLEX_HD.png"
            },
            {
                "c_code": "110",
                "c_name": "STAR GOLD SELECT HD",
                "c_lcn": "194",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566372048STAR_GOLD_SELECT_HD.png"
            },
            {
                "c_code": "111",
                "c_name": "&PICTURES HD",
                "c_lcn": "195",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566372342_PICTURE_HD.png"
            },
            {
                "c_code": "112",
                "c_name": "UTV HD",
                "c_lcn": "196",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566372427UTV_HD.png"
            },
            {
                "c_code": "228",
                "c_name": "STAR MOVIES",
                "c_lcn": "400",
                "a_price": "12",
                "is_logo": "1",
                "logo_name": "1566473657STAR_MOVIES.png"
            },
            {
                "c_code": "229",
                "c_name": "MOVIES NOW",
                "c_lcn": "401",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566473744MOVIES_NOW.png"
            },
            {
                "c_code": "230",
                "c_name": "HBO",
                "c_lcn": "402",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566473897HBO.png"
            },
            {
                "c_code": "231",
                "c_name": "SET PIX",
                "c_lcn": "403",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566474031PIX.png"
            },
            {
                "c_code": "232",
                "c_name": "MNX",
                "c_lcn": "404",
                "a_price": "6",
                "is_logo": "1",
                "logo_name": "1566474125MNX.png"
            },
            {
                "c_code": "233",
                "c_name": "&FLIX",
                "c_lcn": "405",
                "a_price": "15",
                "is_logo": "1",
                "logo_name": "1566474241FLIX.png"
            },
            {
                "c_code": "234",
                "c_name": "ROMEDY NOW",
                "c_lcn": "408",
                "a_price": "6",
                "is_logo": "1",
                "logo_name": "1566474381ROMEDY_NOW.png"
            },
            {
                "c_code": "235",
                "c_name": "WB",
                "c_lcn": "409",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566482496WB.png"
            },
            {
                "c_code": "236",
                "c_name": "STAR MOVIES HD",
                "c_lcn": "415",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566482621STAR_MOVIE_HD.png"
            },
            {
                "c_code": "237",
                "c_name": "MOVIES NOW HD",
                "c_lcn": "416",
                "a_price": "12",
                "is_logo": "1",
                "logo_name": "1566482743MOVIES_NOW_HD.png"
            },
            {
                "c_code": "238",
                "c_name": "PIX HD",
                "c_lcn": "417",
                "a_price": "15",
                "is_logo": "1",
                "logo_name": "1566482846PIX_HD.png"
            },
            {
                "c_code": "239",
                "c_name": "HBO HD",
                "c_lcn": "418",
                "a_price": "15",
                "is_logo": "1",
                "logo_name": "1570879433HBO_HD.png"
            },
            {
                "c_code": "240",
                "c_name": "STAR MOVIES SELECT HD",
                "c_lcn": "419",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566483010STAR_MOVIES_SELECT_HD.png"
            },
            {
                "c_code": "241",
                "c_name": "MNX HD",
                "c_lcn": "420",
                "a_price": "9",
                "is_logo": "1",
                "logo_name": "1566483092MNX_HD.png"
            },
            {
                "c_code": "242",
                "c_name": "ROMEDY NOW HD",
                "c_lcn": "421",
                "a_price": "9",
                "is_logo": "1",
                "logo_name": "1566483181ROMEDY_NOW_HD.png"
            },
            {
                "c_code": "243",
                "c_name": "&FLIX HD",
                "c_lcn": "422",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566483286FLIX_HD.png"
            },
            {
                "c_code": "244",
                "c_name": "MN+ (HD)",
                "c_lcn": "423",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566483383MN+_HD.png"
            },
            {
                "c_code": "245",
                "c_name": "&PRIVE HD",
                "c_lcn": "424",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566483479_PRIVE_HD.png"
            },
            {
                "c_code": "297",
                "c_name": "DABANGG",
                "c_lcn": "677",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566481070DABANGG.png"
            },
            {
                "c_code": "298",
                "c_name": "DANGAL",
                "c_lcn": "107",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570878886Dangal_tv.png"
            },
            {
                "c_code": "299",
                "c_name": "BHOJPURI CINEMA",
                "c_lcn": "681",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566479709BHOJPURI_CINEMA.png"
            },
            {
                "c_code": "300",
                "c_name": "OSCAR MOVIES",
                "c_lcn": "682",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566479633OSCAR_MOVIES.png"
            },
            {
                "c_code": "301",
                "c_name": "DISHUM",
                "c_lcn": "683",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566479512DISHUM_TV.png"
            },
            {
                "c_code": "335",
                "c_name": "GEMINI MOVIES",
                "c_lcn": "758",
                "a_price": "17",
                "is_logo": "1",
                "logo_name": "1566390074GEMINI_MOVIESs.png"
            },
            {
                "c_code": "336",
                "c_name": "MAA MOVIES",
                "c_lcn": "759",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566389994MAA_MOVIES.png"
            },
            {
                "c_code": "337",
                "c_name": "ZEE CINEMALU",
                "c_lcn": "760",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566389922ZEE_CINEMALU.png"
            },
            {
                "c_code": "361",
                "c_name": "UDAYA MOVIES",
                "c_lcn": "806",
                "a_price": "16",
                "is_logo": "1",
                "logo_name": "1566386683UDAYA_MOVIES.png"
            },
            {
                "c_code": "373",
                "c_name": "SURYA MOVIES",
                "c_lcn": "831",
                "a_price": "11",
                "is_logo": "1",
                "logo_name": "1566381037SURYA_MOVIES.png"
            },
            {
                "c_code": "374",
                "c_name": "ASIANET MOVIES",
                "c_lcn": "834",
                "a_price": "15",
                "is_logo": "1",
                "logo_name": "1566380806ASIANET_MOVIES.png"
            },
            {
                "c_code": "382",
                "c_name": "COLORS GUJARATI CINEMA",
                "c_lcn": "853",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566379475COLORS_GUJRATI_CINEMA.png"
            },
            {
                "c_code": "421",
                "c_name": "ENTER10 MOVIES",
                "c_lcn": "173",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570879176Enterr10.png"
            },
            {
                "c_code": "422",
                "c_name": "ENTER10",
                "c_lcn": "174",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570880914Shaandaar_Cinema.png"
            },
            {
                "c_code": "427",
                "c_name": "PITAARA",
                "c_lcn": "731",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570880724Pitaara.png"
            },
            {
                "c_code": "429",
                "c_name": "ZEE CLASSIC",
                "c_lcn": "159",
                "a_price": "0.5",
                "is_logo": "1",
                "logo_name": "1572593023ZEE_CLASSIC.png"
            },
            {
                "c_code": "431",
                "c_name": "&XPLOR HD",
                "c_lcn": "197",
                "a_price": "4",
                "is_logo": "1",
                "logo_name": "1574073134XPLOR_HD.png"
            },
            {
                "c_code": "445",
                "c_name": "RISHTEY CINEPLEX",
                "c_lcn": "170",
                "a_price": "0.25",
                "is_logo": "1",
                "logo_name": "1593765325download.jpg"
            },
            {
                "c_code": "446",
                "c_name": "DHINCHAAK",
                "c_lcn": "172",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1597549719index.png"
            },
            {
                "c_code": "448",
                "c_name": "ONE BANGLA MOVIES",
                "c_lcn": "52",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1597554828KCBPL_ONE_BANGLA_CINEMA.png"
            }
        ],
        "ch_qt": "71"
    },
    {
        "genre_id_a": "4",
        "gen_name_a": "NEWS",
        "ch_list": [
            {
                "c_code": "37",
                "c_name": "ABP ANANDA",
                "c_lcn": "60",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566214987ABP_ANANDA.png"
            },
            {
                "c_code": "38",
                "c_name": "NEWS18 BANGLA",
                "c_lcn": "61",
                "a_price": "0.25",
                "is_logo": "1",
                "logo_name": "1566215109NEWS18_BANGLA.png"
            },
            {
                "c_code": "39",
                "c_name": "24 GHANTA",
                "c_lcn": "62",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "156621533424_GHANTA.png"
            },
            {
                "c_code": "41",
                "c_name": "KOLKATA TV",
                "c_lcn": "64",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566215855KOLKATA_TV.png"
            },
            {
                "c_code": "42",
                "c_name": "R PLUS",
                "c_lcn": "65",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570884438Rplus_News.png"
            },
            {
                "c_code": "43",
                "c_name": "BHOOMI 24x7",
                "c_lcn": "69",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566216213BHOOMI_24x7.png"
            },
            {
                "c_code": "44",
                "c_name": "KOLKATA LIVE",
                "c_lcn": "67",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570879606Kolkata_live.png"
            },
            {
                "c_code": "46",
                "c_name": "NEWS TIME BANGLA",
                "c_lcn": "66",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566216689NEWS_TIME_BANGLA.png"
            },
            {
                "c_code": "47",
                "c_name": "CALCUTTA NEWS",
                "c_lcn": "63",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566216789CALCUTTA_NEWS.png"
            },
            {
                "c_code": "48",
                "c_name": "JAYATU BANGLA",
                "c_lcn": "75",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566217024JAYATU_BANGLA.png"
            },
            {
                "c_code": "49",
                "c_name": "ARTAGE NEWS",
                "c_lcn": "76",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566217206ARTAGE_NEWS.png"
            },
            {
                "c_code": "50",
                "c_name": "CHANNEL 10",
                "c_lcn": "77",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566385229channel_10.png"
            },
            {
                "c_code": "52",
                "c_name": "BANGLA TIME",
                "c_lcn": "82",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566217725BANGLA_TIME.png"
            },
            {
                "c_code": "53",
                "c_name": "JAGO BANGLA",
                "c_lcn": "86",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570878581Bangla_Jago.png"
            },
            {
                "c_code": "113",
                "c_name": "RBHARAT",
                "c_lcn": "200",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566372860R_BHARAT.png"
            },
            {
                "c_code": "114",
                "c_name": "ABP NEWS",
                "c_lcn": "201",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566372995ABP_NEWS.png"
            },
            {
                "c_code": "115",
                "c_name": "NEWS18 INDIA",
                "c_lcn": "202",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566373107NEWS18_INDIA.png"
            },
            {
                "c_code": "116",
                "c_name": "NEWS NATION",
                "c_lcn": "204",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566373281NEWS_NATION.png"
            },
            {
                "c_code": "117",
                "c_name": "INDIA TV",
                "c_lcn": "205",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566373437INDIA_TV.png"
            },
            {
                "c_code": "118",
                "c_name": "ZEE NEWS",
                "c_lcn": "215",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566373898ZEE_NEWS.png"
            },
            {
                "c_code": "119",
                "c_name": "AAJ TAK",
                "c_lcn": "207",
                "a_price": "0.75",
                "is_logo": "1",
                "logo_name": "1566374028AAJ_TAK.png"
            },
            {
                "c_code": "120",
                "c_name": "TV9 BHARATVARSH",
                "c_lcn": "208",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566374238TV9_BHARATVARSH.png"
            },
            {
                "c_code": "121",
                "c_name": "ZEE HINDUSTAN",
                "c_lcn": "209",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566374407ZEE_HINDUSTHAN.png"
            },
            {
                "c_code": "122",
                "c_name": "DD NEWS",
                "c_lcn": "216",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566374548DD_NEWS.png"
            },
            {
                "c_code": "123",
                "c_name": "JK CHANNEL",
                "c_lcn": "211",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566374787JK_24X7_NEWS.png"
            },
            {
                "c_code": "124",
                "c_name": "TAAZA TV",
                "c_lcn": "213",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566374990TAAZA_TV.png"
            },
            {
                "c_code": "125",
                "c_name": "TEZ",
                "c_lcn": "210",
                "a_price": "0.25",
                "is_logo": "1",
                "logo_name": "1566376986AAJ_TAK_TEZ.png"
            },
            {
                "c_code": "126",
                "c_name": "CNBC AWAAZ",
                "c_lcn": "221",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566377369CNBC_AWAAZ.png"
            },
            {
                "c_code": "127",
                "c_name": "ZEE BUSINESS",
                "c_lcn": "222",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566377572ZEE_BUSINESS.png"
            },
            {
                "c_code": "128",
                "c_name": "CNBC BAJAAR",
                "c_lcn": "223",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566377832CNBC_BAJAAR.png"
            },
            {
                "c_code": "129",
                "c_name": "AAJ TAK HD",
                "c_lcn": "225",
                "a_price": "1.5",
                "is_logo": "1",
                "logo_name": "1566378149AAJ_TAK_HD.png"
            },
            {
                "c_code": "130",
                "c_name": "NDTV INDIA",
                "c_lcn": "227",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566544643NDTV_India.png"
            },
            {
                "c_code": "131",
                "c_name": "DD LOKSABHA",
                "c_lcn": "228",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566381737LOKSABHA.png"
            },
            {
                "c_code": "132",
                "c_name": "DD RAJYASABHA",
                "c_lcn": "229",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566382191DD_RAJYA_SABHA.png"
            },
            {
                "c_code": "201",
                "c_name": "DD INDIA",
                "c_lcn": "226",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566470005DD_INDIA.png"
            },
            {
                "c_code": "246",
                "c_name": "TIMES NOW",
                "c_lcn": "425",
                "a_price": "3",
                "is_logo": "1",
                "logo_name": "1566483550TIMES_NOW.png"
            },
            {
                "c_code": "247",
                "c_name": "REPUBLIC TV",
                "c_lcn": "426",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566483615REPUBLIC_TV.png"
            },
            {
                "c_code": "248",
                "c_name": "CNN NEWS18",
                "c_lcn": "427",
                "a_price": "0.5",
                "is_logo": "1",
                "logo_name": "1566483689CNN_NEWS18.png"
            },
            {
                "c_code": "249",
                "c_name": "INDIA TODAY",
                "c_lcn": "428",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566483755INDIA_TODAY.png"
            },
            {
                "c_code": "250",
                "c_name": "MIRROR NOW",
                "c_lcn": "429",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1566483827MIRROR_NOW.png"
            },
            {
                "c_code": "251",
                "c_name": "CNN INTERNATIONAL",
                "c_lcn": "431",
                "a_price": "0.5",
                "is_logo": "1",
                "logo_name": "1566483973CNN_INTERNATIONAL.png"
            },
            {
                "c_code": "252",
                "c_name": "WION",
                "c_lcn": "432",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566484045WION.png"
            },
            {
                "c_code": "253",
                "c_name": "BBC WORLD NEWS",
                "c_lcn": "433",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566484140BBC_WORLD_NEWS.png"
            },
            {
                "c_code": "254",
                "c_name": "AL JAZEERA",
                "c_lcn": "434",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566484240ALZAJEERA.png"
            },
            {
                "c_code": "255",
                "c_name": "CHANNEL NEWS ASIA INTERNATIONAL",
                "c_lcn": "435",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566540742NEWS_ASIA.png"
            },
            {
                "c_code": "256",
                "c_name": "NDTV 24X7",
                "c_lcn": "437",
                "a_price": "3",
                "is_logo": "1",
                "logo_name": "1566540854NDTV_24X7.png"
            },
            {
                "c_code": "257",
                "c_name": "CNBC TV18",
                "c_lcn": "438",
                "a_price": "4",
                "is_logo": "1",
                "logo_name": "1566540928CNBC_TV18.png"
            },
            {
                "c_code": "258",
                "c_name": "ET NOW",
                "c_lcn": "439",
                "a_price": "3",
                "is_logo": "1",
                "logo_name": "1566541271ET_NOW.png"
            },
            {
                "c_code": "259",
                "c_name": "CNBC TV18 PRIME HD",
                "c_lcn": "445",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566541446CNBC_TV18_PRIME_HD.png"
            },
            {
                "c_code": "260",
                "c_name": "TIMES NOW WORLD (HD)",
                "c_lcn": "446",
                "a_price": "5",
                "is_logo": "1",
                "logo_name": "1566541551TIMES_NOW_WORLD_(HD).png"
            },
            {
                "c_code": "281",
                "c_name": "NEPAL 1",
                "c_lcn": "550",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566483079NEPAL1.png"
            },
            {
                "c_code": "282",
                "c_name": "TV5 MONDE",
                "c_lcn": "551",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570881269Tv5_Monde.png"
            },
            {
                "c_code": "283",
                "c_name": "DW TV",
                "c_lcn": "552",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566482887DW_TV.png"
            },
            {
                "c_code": "284",
                "c_name": "ARIRANG",
                "c_lcn": "554",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566482789ARIRANG_TV.png"
            },
            {
                "c_code": "285",
                "c_name": "CUBAVISION",
                "c_lcn": "557",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566482663CUBAVISION.png"
            },
            {
                "c_code": "286",
                "c_name": "RTPI",
                "c_lcn": "558",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566482578RTPI.png"
            },
            {
                "c_code": "287",
                "c_name": "RTR PLANETA",
                "c_lcn": "559",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566482457RTR_PLANETA.png"
            },
            {
                "c_code": "291",
                "c_name": "DY 365",
                "c_lcn": "662",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566481666DY_365.png"
            },
            {
                "c_code": "292",
                "c_name": "NEWS LIVE",
                "c_lcn": "663",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566481549NEWS_LIVE.png"
            },
            {
                "c_code": "293",
                "c_name": "PRATIDIN TIME",
                "c_lcn": "664",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566481478PRATIDIN_TIME.png"
            },
            {
                "c_code": "294",
                "c_name": "NEWS18 ASSAM-NORTH EAST",
                "c_lcn": "666",
                "a_price": "0.25",
                "is_logo": "1",
                "logo_name": "1566481353NEWS18_ASSAM_NORT_EAST.png"
            },
            {
                "c_code": "303",
                "c_name": "NEWS18 BIHAR-JHARKHAND",
                "c_lcn": "687",
                "a_price": "0.25",
                "is_logo": "1",
                "logo_name": "1566479238NEWS18_BIHAR_JHARKHAND.png"
            },
            {
                "c_code": "304",
                "c_name": "SAMAY BIHAR-JHARKHAND",
                "c_lcn": "688",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566479065SAHARA_SAMAY_BIHAR.png"
            },
            {
                "c_code": "305",
                "c_name": "ZEE BIHAR JHARKHAND",
                "c_lcn": "689",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566478972ZEE_BIHAR_JHARKHAND.png"
            },
            {
                "c_code": "312",
                "c_name": "O TV",
                "c_lcn": "712",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570880370Odisha_tv.png"
            },
            {
                "c_code": "313",
                "c_name": "ZEE ODISHA",
                "c_lcn": "704",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566477972ZEE_ODISHA.png"
            },
            {
                "c_code": "314",
                "c_name": "NEWS18 ODIA",
                "c_lcn": "714",
                "a_price": "0.25",
                "is_logo": "1",
                "logo_name": "1566477862NEWS_18_ODIA.png"
            },
            {
                "c_code": "315",
                "c_name": "KANAK NEWS",
                "c_lcn": "715",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566477650KANAK_NEWS.png"
            },
            {
                "c_code": "316",
                "c_name": "PRAMEYA NEWS7",
                "c_lcn": "716",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566477545PRAMEYA_NEWS7.png"
            },
            {
                "c_code": "319",
                "c_name": "NEWS18 PUNJAB-HARYANA-HIMACHAL PRADESH",
                "c_lcn": "725",
                "a_price": "0.25",
                "is_logo": "1",
                "logo_name": "1566477042NEWS18_PUNJAB_HARYANA_HIMACHAL_PRADESH.png"
            },
            {
                "c_code": "320",
                "c_name": "ZEE PUNJAB HARYANA HIMACHAL",
                "c_lcn": "726",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566476800ZEE_PUNJAB_HARYANA_HIMACHAL.png"
            },
            {
                "c_code": "322",
                "c_name": "CHARDIKLA TIME TV",
                "c_lcn": "728",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566476482CHARDIKLA_TIME_TV.png"
            },
            {
                "c_code": "323",
                "c_name": "PTC NEWS",
                "c_lcn": "737",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566476378PTC_NEWS.png"
            },
            {
                "c_code": "339",
                "c_name": "ETV ANDHRA PRADESH",
                "c_lcn": "762",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566389768ETV_ANDHRA_PRADESH.png"
            },
            {
                "c_code": "340",
                "c_name": "TV 9 TELUGU",
                "c_lcn": "763",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566389673TV9_TELEGU.png"
            },
            {
                "c_code": "353",
                "c_name": "SUN NEWS",
                "c_lcn": "787",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566388048Sun_News.png"
            },
            {
                "c_code": "365",
                "c_name": "SUVARNA NEWS",
                "c_lcn": "816",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566386349SUVARNA_NEWS_24X7.png"
            },
            {
                "c_code": "376",
                "c_name": "ASIANET NEWS",
                "c_lcn": "837",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566380329ASIANET_NEWS.png"
            },
            {
                "c_code": "380",
                "c_name": "DD GIRNAR",
                "c_lcn": "851",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566379752DD_GIRNAR.png"
            },
            {
                "c_code": "383",
                "c_name": "NIRMANA TV",
                "c_lcn": "854",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566379396NIRMANA.png"
            },
            {
                "c_code": "384",
                "c_name": "GUJARAT NEWS",
                "c_lcn": "855",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570879289Gujarat_news.png"
            },
            {
                "c_code": "385",
                "c_name": "ZEE 24 KALAK",
                "c_lcn": "856",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1570881458zee-24kalak.png"
            },
            {
                "c_code": "388",
                "c_name": "NEWS18 RAJASTHAN",
                "c_lcn": "866",
                "a_price": "0.25",
                "is_logo": "1",
                "logo_name": "1566378616NEWS18_RAJASTHAN.png"
            },
            {
                "c_code": "389",
                "c_name": "ZEE RAJASTHAN NEWS",
                "c_lcn": "867",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566377709ZEE_RAJASHTAN.png"
            },
            {
                "c_code": "392",
                "c_name": "NEWS18 URDU",
                "c_lcn": "900",
                "a_price": "0.25",
                "is_logo": "1",
                "logo_name": "1566377478NEWS18_URDU.png"
            },
            {
                "c_code": "393",
                "c_name": "ZEE SALAAM",
                "c_lcn": "901",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566377316ZEE_SALAAM.png"
            },
            {
                "c_code": "394",
                "c_name": "AALAMI SAHARA",
                "c_lcn": "902",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570878340Aalami_Sahara.png"
            },
            {
                "c_code": "395",
                "c_name": "DD URDU",
                "c_lcn": "903",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566377085DD_URDU.png"
            },
            {
                "c_code": "396",
                "c_name": "CHANNEL WIN",
                "c_lcn": "904",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566376997CHANNEL_WIN.png"
            },
            {
                "c_code": "401",
                "c_name": "ZEE 24 TAAS",
                "c_lcn": "912",
                "a_price": "0.5",
                "is_logo": "1",
                "logo_name": "1566370451ZEE_24_TAAS.png"
            },
            {
                "c_code": "406",
                "c_name": "NEWS18 LOKMAT",
                "c_lcn": "917",
                "a_price": "0.25",
                "is_logo": "1",
                "logo_name": "1566369567NEWS18_LOKMAT.png"
            },
            {
                "c_code": "407",
                "c_name": "ABP MAJHA",
                "c_lcn": "918",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566369315ABP_MAJHA.png"
            },
            {
                "c_code": "409",
                "c_name": "NEWS18 MADHYA PRADESH-CHHATTISGARH",
                "c_lcn": "922",
                "a_price": "0.25",
                "is_logo": "1",
                "logo_name": "1566369007NEWS18_M_P_CHATTISGARH.png"
            },
            {
                "c_code": "410",
                "c_name": "ZEE MADHYA PRADESH CHATTISGARH",
                "c_lcn": "923",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566368822ZEE_M_P_CHHATTISGARH.png"
            },
            {
                "c_code": "411",
                "c_name": "NEWS18 UTTAR PRADESH-UTTARAKHAND",
                "c_lcn": "925",
                "a_price": "0.25",
                "is_logo": "1",
                "logo_name": "1566368715NEWS18_UTTAR_PRADESH_UT.png"
            },
            {
                "c_code": "412",
                "c_name": "ZEE UTTAR PRADESH UTTARAKHAND",
                "c_lcn": "926",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566368573ZEE_UTTAR_PRADESH_UTTARAKHAND.png"
            },
            {
                "c_code": "416",
                "c_name": "EXPRESS NEWS",
                "c_lcn": "70",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570879225Express-News-Logo.png"
            },
            {
                "c_code": "424",
                "c_name": "HIGH NEWS",
                "c_lcn": "71",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570879458High_news.png"
            },
            {
                "c_code": "425",
                "c_name": "MBC TV",
                "c_lcn": "711",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570879632MBC-TV-logo.png"
            },
            {
                "c_code": "426",
                "c_name": "NAXATRA NEWS",
                "c_lcn": "717",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570880346Naxatra_News.png"
            },
            {
                "c_code": "428",
                "c_name": "KALINGA TV",
                "c_lcn": "710",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570879581KalingaTV.png"
            },
            {
                "c_code": "435",
                "c_name": "NHK WORLD",
                "c_lcn": "555",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1579252408NHK_WORLD.png"
            },
            {
                "c_code": "436",
                "c_name": "NANDIGHOSHA TV",
                "c_lcn": "719",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1584341775Nandighosha_TV.png"
            }
        ],
        "ch_qt": "103"
    },
    {
        "genre_id_a": "5",
        "gen_name_a": "MUSIC",
        "ch_list": [
            {
                "c_code": "54",
                "c_name": "MUSIC F",
                "c_lcn": "91",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566285647MUSIC_F.png"
            },
            {
                "c_code": "55",
                "c_name": "SANGEET BANGLA",
                "c_lcn": "92",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566285514SANGEET_BANGLA.png"
            },
            {
                "c_code": "57",
                "c_name": "T TV",
                "c_lcn": "94",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570887886Tara_tv.png"
            },
            {
                "c_code": "58",
                "c_name": "DHOOM MUSIC BANGLA",
                "c_lcn": "99",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566286112DHOOM_MUSIC_BANGLA.png"
            },
            {
                "c_code": "72",
                "c_name": "ZOOM",
                "c_lcn": "232",
                "a_price": "0.5",
                "is_logo": "1",
                "logo_name": "1570884488Zoom(TVchannel)Logo.png"
            },
            {
                "c_code": "133",
                "c_name": "MTV",
                "c_lcn": "230",
                "a_price": "3",
                "is_logo": "1",
                "logo_name": "1566382477M_TV.png"
            },
            {
                "c_code": "136",
                "c_name": "ZING",
                "c_lcn": "233",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566382825ZING.png"
            },
            {
                "c_code": "138",
                "c_name": "I LOVE",
                "c_lcn": "236",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1597552493index_12.png"
            },
            {
                "c_code": "139",
                "c_name": "ZEE ETC",
                "c_lcn": "237",
                "a_price": "0.1",
                "is_logo": "1",
                "logo_name": "1566383505ZEE_ETC.png"
            },
            {
                "c_code": "140",
                "c_name": "MTV BEATS",
                "c_lcn": "239",
                "a_price": "0.5",
                "is_logo": "1",
                "logo_name": "1566383619MTV_BEATS.png"
            },
            {
                "c_code": "141",
                "c_name": "MUSIC INDIA",
                "c_lcn": "241",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566383799MUSIC_INDIA.png"
            },
            {
                "c_code": "142",
                "c_name": "MTV HD+",
                "c_lcn": "246",
                "a_price": "5",
                "is_logo": "1",
                "logo_name": "1566383917MTV_HD+.png"
            },
            {
                "c_code": "143",
                "c_name": "MTV BEATS HD",
                "c_lcn": "247",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566384046MTV_BEATS_HD.png"
            },
            {
                "c_code": "261",
                "c_name": "VH1",
                "c_lcn": "450",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1570881302VH1_sd.png"
            },
            {
                "c_code": "263",
                "c_name": "VH1 HD",
                "c_lcn": "460",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1570881323VH1_HD.png"
            },
            {
                "c_code": "306",
                "c_name": "SANGEET BHOJPURI",
                "c_lcn": "693",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566478896SANGEET_BHOJPURE.png"
            },
            {
                "c_code": "317",
                "c_name": "TARANG MUSIC",
                "c_lcn": "720",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1566477384TARANG_MUSIC.png"
            },
            {
                "c_code": "325",
                "c_name": "MH 1 MUSIC",
                "c_lcn": "743",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566465776MH_ONE.png"
            },
            {
                "c_code": "327",
                "c_name": "PTC CHAK DE",
                "c_lcn": "745",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566465500PTC_CHAK_DE.png"
            },
            {
                "c_code": "342",
                "c_name": "MAA MUSIC",
                "c_lcn": "768",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566389542MAA_MUSIC.png"
            },
            {
                "c_code": "343",
                "c_name": "GEMINI MUSIC",
                "c_lcn": "769",
                "a_price": "4",
                "is_logo": "1",
                "logo_name": "1566389326GEMINI_MUSIC.png"
            },
            {
                "c_code": "354",
                "c_name": "SUN MUSIC",
                "c_lcn": "793",
                "a_price": "6",
                "is_logo": "1",
                "logo_name": "1566387858SUN_MUSIC.png"
            },
            {
                "c_code": "355",
                "c_name": "MEGA MUSIC",
                "c_lcn": "794",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570880283Mega-Musiq.png"
            },
            {
                "c_code": "366",
                "c_name": "UDAYA MUSIC",
                "c_lcn": "818",
                "a_price": "6",
                "is_logo": "1",
                "logo_name": "1566386281UDAYA_MUSIC.png"
            },
            {
                "c_code": "377",
                "c_name": "SURYA MUSIC",
                "c_lcn": "843",
                "a_price": "4",
                "is_logo": "1",
                "logo_name": "1566380076SURYA_MUSIC.png"
            },
            {
                "c_code": "386",
                "c_name": "GTPL MUSIC",
                "c_lcn": "857",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566379014GTPL_MUSIC.png"
            },
            {
                "c_code": "433",
                "c_name": "MASTIII",
                "c_lcn": "238",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1576483203Mastiii_Sabgroup.png"
            },
            {
                "c_code": "447",
                "c_name": "ONE SANGEET",
                "c_lcn": "90",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1597554476KCBPL_ONE_SANGEET_LOGO.png"
            },
            {
                "c_code": "449",
                "c_name": "SHOWBOX",
                "c_lcn": "240",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1600204680531-5318747_showbox-channel-hd-png-download.png"
            }
        ],
        "ch_qt": "29"
    },
    {
        "genre_id_a": "6",
        "gen_name_a": "SPORTS",
        "ch_list": [
            {
                "c_code": "144",
                "c_name": "STAR SPORTS 1",
                "c_lcn": "250",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566384333STAR_SPORTS_1.png"
            },
            {
                "c_code": "145",
                "c_name": "STAR SPORTS 2",
                "c_lcn": "251",
                "a_price": "6",
                "is_logo": "1",
                "logo_name": "1566384507STAR_SPORTS_2.png"
            },
            {
                "c_code": "146",
                "c_name": "STAR SPORTS 3",
                "c_lcn": "252",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1566384739STAR_SPORTS_3.png"
            },
            {
                "c_code": "147",
                "c_name": "STAR SPORTS 1 HINDI",
                "c_lcn": "253",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1570881128Star-Sports-1-Hindi.png"
            },
            {
                "c_code": "148",
                "c_name": "STAR SPORTS SELECT 1",
                "c_lcn": "254",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566385074STAR_SPORTS_SELECT_1.png"
            },
            {
                "c_code": "149",
                "c_name": "SIX",
                "c_lcn": "255",
                "a_price": "15",
                "is_logo": "1",
                "logo_name": "1566385583SIX.png"
            },
            {
                "c_code": "150",
                "c_name": "TEN 1",
                "c_lcn": "256",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566385723TEN_1.png"
            },
            {
                "c_code": "151",
                "c_name": "TEN 2",
                "c_lcn": "257",
                "a_price": "15",
                "is_logo": "1",
                "logo_name": "1566385817TEN_2.png"
            },
            {
                "c_code": "152",
                "c_name": "TEN 3",
                "c_lcn": "258",
                "a_price": "17",
                "is_logo": "1",
                "logo_name": "1566385978TEN_3.png"
            },
            {
                "c_code": "154",
                "c_name": "STAR SPORTS 1 BANGLA",
                "c_lcn": "263",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566386432STAR_SPORTS_1_BANGLA.png"
            },
            {
                "c_code": "155",
                "c_name": "STAR SPORTS SELECT 2",
                "c_lcn": "262",
                "a_price": "7",
                "is_logo": "1",
                "logo_name": "1566386624STAR_SPORTS_SELECT_2.png"
            },
            {
                "c_code": "156",
                "c_name": "EUROSPORTS",
                "c_lcn": "260",
                "a_price": "4",
                "is_logo": "1",
                "logo_name": "1566456996DSPORT.png"
            },
            {
                "c_code": "157",
                "c_name": "STAR SPORTS FIRST",
                "c_lcn": "264",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566457124STAR_SPORTS_FIRST.png"
            },
            {
                "c_code": "158",
                "c_name": "STAR SPORTS 1 TELUGU",
                "c_lcn": "265",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566457218STAR_SPORTS_1_TELEGU.png"
            },
            {
                "c_code": "159",
                "c_name": "DD SPORTS",
                "c_lcn": "274",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566457385DD_SPORTS.png"
            },
            {
                "c_code": "160",
                "c_name": "STAR SPORTS HD1",
                "c_lcn": "275",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566457884STAR_SPORTS_HD_1.png"
            },
            {
                "c_code": "161",
                "c_name": "STAR SPORTS HD2",
                "c_lcn": "276",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566457973STAR_SPORTS_HD_2.png"
            },
            {
                "c_code": "162",
                "c_name": "STAR SPORTS 1 HD HINDI",
                "c_lcn": "277",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1570884468Star_sports_1_hindi_hd.png"
            },
            {
                "c_code": "163",
                "c_name": "STAR SPORTS SELECT HD1",
                "c_lcn": "278",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1570880969star_sports_select_1_hd.png"
            },
            {
                "c_code": "164",
                "c_name": "STAR SPORTS SELECT HD2",
                "c_lcn": "279",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566458439STAR_SPORTS_SELECT_HD_2.png"
            },
            {
                "c_code": "165",
                "c_name": "TEN 1 HD",
                "c_lcn": "280",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566458519TEN_1_HD.png"
            },
            {
                "c_code": "166",
                "c_name": "TEN 2 HD",
                "c_lcn": "281",
                "a_price": "17",
                "is_logo": "1",
                "logo_name": "1566458606TEN_2_HD.png"
            },
            {
                "c_code": "167",
                "c_name": "TEN 3 HD",
                "c_lcn": "282",
                "a_price": "17",
                "is_logo": "1",
                "logo_name": "1566458695TEN_3_HD.png"
            },
            {
                "c_code": "169",
                "c_name": "SIX HD",
                "c_lcn": "284",
                "a_price": "19",
                "is_logo": "1",
                "logo_name": "1566459610SIX_HD.png"
            }
        ],
        "ch_qt": "24"
    },
    {
        "genre_id_a": "7",
        "gen_name_a": "INFOTAINMENT",
        "ch_list": [
            {
                "c_code": "184",
                "c_name": "DISCOVERY CHANNEL",
                "c_lcn": "335",
                "a_price": "4",
                "is_logo": "1",
                "logo_name": "1566462019DISCOVERY_CHANNEL.png"
            },
            {
                "c_code": "185",
                "c_name": "THE HISTORY CHANNEL",
                "c_lcn": "336",
                "a_price": "3",
                "is_logo": "1",
                "logo_name": "1566462107THE_HISTORY_CHANNEL.png"
            },
            {
                "c_code": "186",
                "c_name": "NATIONAL GEOGRAPHIC",
                "c_lcn": "337",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1566462215NATIONAL_GEOGRAPHIC.png"
            },
            {
                "c_code": "187",
                "c_name": "SONY BBC EARTH",
                "c_lcn": "338",
                "a_price": "4",
                "is_logo": "1",
                "logo_name": "1566476297SONY_BBC_EARTH.png"
            },
            {
                "c_code": "188",
                "c_name": "ANIMAL PLANET",
                "c_lcn": "339",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1570878554animal-planet-logo.png"
            },
            {
                "c_code": "189",
                "c_name": "NAT GEO WILD",
                "c_lcn": "340",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566476326NAT_GEO_WILD.png"
            },
            {
                "c_code": "190",
                "c_name": "DISCOVERY SCIENCE",
                "c_lcn": "341",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566462745DISCOVERY_SCIENCE.png"
            },
            {
                "c_code": "191",
                "c_name": "EPIC TV",
                "c_lcn": "342",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1566463289EPIC_TV.png"
            },
            {
                "c_code": "192",
                "c_name": "FOX LIFE",
                "c_lcn": "343",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566463392FOX_LIFE.png"
            },
            {
                "c_code": "193",
                "c_name": "TLC",
                "c_lcn": "344",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1566463603TLC.png"
            },
            {
                "c_code": "195",
                "c_name": "TRAVELXP",
                "c_lcn": "348",
                "a_price": "3",
                "is_logo": "1",
                "logo_name": "1566469279TRAVEL_XP.png"
            },
            {
                "c_code": "196",
                "c_name": "DISCOVERY TURBO",
                "c_lcn": "347",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566469372TURBO.png"
            },
            {
                "c_code": "197",
                "c_name": "LIVING FOODZ",
                "c_lcn": "346",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566469458LIVING_FOODZ.png"
            },
            {
                "c_code": "198",
                "c_name": "FOOD FOOD",
                "c_lcn": "349",
                "a_price": "0.3",
                "is_logo": "1",
                "logo_name": "1566469575FOOD_FOOD.png"
            },
            {
                "c_code": "199",
                "c_name": "FASHION TV",
                "c_lcn": "367",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566469674FTV_INDIA.png"
            },
            {
                "c_code": "200",
                "c_name": "SWAYAM PRABHA",
                "c_lcn": "351",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566469923SWAYAM_PRABHA.png"
            },
            {
                "c_code": "202",
                "c_name": "DD KISAN",
                "c_lcn": "353",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566470119DD_KISAN.png"
            },
            {
                "c_code": "203",
                "c_name": "DD BHARATI",
                "c_lcn": "354",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566470266DD_BHARTI.png"
            },
            {
                "c_code": "204",
                "c_name": "DD GYANDARSHAN 1",
                "c_lcn": "355",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566470383DD_GYANDARSHAN_1.png"
            },
            {
                "c_code": "205",
                "c_name": "SONY BBC EARTH HD",
                "c_lcn": "359",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566470486BBC_EARTH_HD.png"
            },
            {
                "c_code": "206",
                "c_name": "HISTORY TV18 HD",
                "c_lcn": "357",
                "a_price": "7",
                "is_logo": "1",
                "logo_name": "1566470615HISTORY_CHANNEL_HD.png"
            },
            {
                "c_code": "207",
                "c_name": "NATIONAL GEOGRAPHIC HD",
                "c_lcn": "358",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566470782NATIONAL_GEOGRAPHIC_HD.png"
            },
            {
                "c_code": "208",
                "c_name": "NAT GEO WILD HD",
                "c_lcn": "361",
                "a_price": "5",
                "is_logo": "1",
                "logo_name": "1566470924NAT_GEO_WILD_HD.png"
            },
            {
                "c_code": "209",
                "c_name": "ANIMAL PLANET HD WORLD",
                "c_lcn": "360",
                "a_price": "3",
                "is_logo": "1",
                "logo_name": "1570878504Animal_Planet_HD.png"
            },
            {
                "c_code": "210",
                "c_name": "DISCOVERY HD",
                "c_lcn": "356",
                "a_price": "6",
                "is_logo": "1",
                "logo_name": "1574079072DISCOVERY_LOGO_HD.png"
            },
            {
                "c_code": "211",
                "c_name": "FOX LIFE HD",
                "c_lcn": "362",
                "a_price": "1",
                "is_logo": "1",
                "logo_name": "1566471332FOX_LIFE_HD.png"
            },
            {
                "c_code": "212",
                "c_name": "TLC HD WORLD",
                "c_lcn": "363",
                "a_price": "3",
                "is_logo": "1",
                "logo_name": "1570881238Tlc_hd.png"
            },
            {
                "c_code": "214",
                "c_name": "LIVING FOODZ HD",
                "c_lcn": "365",
                "a_price": "10",
                "is_logo": "1",
                "logo_name": "1566471799LIVING_FOODZ_HD.png"
            },
            {
                "c_code": "215",
                "c_name": "TRAVELXP HD",
                "c_lcn": "366",
                "a_price": "9",
                "is_logo": "1",
                "logo_name": "1566471869TRAVEL_XP_HD.png"
            },
            {
                "c_code": "414",
                "c_name": "CUSTOMER INFO",
                "c_lcn": "999",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570887759Info.png"
            },
            {
                "c_code": "430",
                "c_name": "GOODTIMES",
                "c_lcn": "350",
                "a_price": "1.5",
                "is_logo": "1",
                "logo_name": "1572592947GOOD_TIMES.png"
            }
        ],
        "ch_qt": "31"
    },
    {
        "genre_id_a": "8",
        "gen_name_a": "RELIGIOUS",
        "ch_list": [
            {
                "c_code": "264",
                "c_name": "AASTHA",
                "c_lcn": "500",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566542155ASTHA.png"
            },
            {
                "c_code": "265",
                "c_name": "AASTHA BHAJAN",
                "c_lcn": "501",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566542251ASTHA_BHAJAN.png"
            },
            {
                "c_code": "266",
                "c_name": "SANATAN",
                "c_lcn": "502",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566542401SANATAN.png"
            },
            {
                "c_code": "267",
                "c_name": "SANSKAR",
                "c_lcn": "503",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566542476SANSKAR.png"
            },
            {
                "c_code": "268",
                "c_name": "GOD TV",
                "c_lcn": "504",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566484155GOD_TV.png"
            },
            {
                "c_code": "269",
                "c_name": "35 MM",
                "c_lcn": "505",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "157087817135_mm.png"
            },
            {
                "c_code": "270",
                "c_name": "BANGLA BHAKTI",
                "c_lcn": "506",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570878636Bangla-Bhakti.png"
            },
            {
                "c_code": "271",
                "c_name": "PEACE OF MIND",
                "c_lcn": "507",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566484012PEACE_OF_MIND.png"
            },
            {
                "c_code": "272",
                "c_name": "DIVYA",
                "c_lcn": "508",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566483939DIVYA.png"
            },
            {
                "c_code": "273",
                "c_name": "PARAS GOLD",
                "c_lcn": "510",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566483852PARAS.png"
            },
            {
                "c_code": "274",
                "c_name": "JINVANI",
                "c_lcn": "511",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566483776JINVANI.png"
            },
            {
                "c_code": "275",
                "c_name": "ARIHANT",
                "c_lcn": "512",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566483715ARIHANT.png"
            },
            {
                "c_code": "276",
                "c_name": "SOHAM",
                "c_lcn": "513",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566483572SOHAM.png"
            },
            {
                "c_code": "277",
                "c_name": "SRI SANKARA",
                "c_lcn": "514",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566483487SRI_SANKARA.png"
            },
            {
                "c_code": "278",
                "c_name": "SATSANG",
                "c_lcn": "515",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566483375SATSANG.png"
            },
            {
                "c_code": "279",
                "c_name": "SADHANA BHAKTI",
                "c_lcn": "516",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566483283SADHANA.png"
            },
            {
                "c_code": "280",
                "c_name": "HOPE INDIA",
                "c_lcn": "517",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566483177HOPE_INDIA.png"
            },
            {
                "c_code": "318",
                "c_name": "PRARTHANA",
                "c_lcn": "722",
                "a_price": "2",
                "is_logo": "1",
                "logo_name": "1566477265PARTHANA.png"
            },
            {
                "c_code": "345",
                "c_name": "BHAKTI",
                "c_lcn": "773",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1570878679bhakthi-tv.png"
            },
            {
                "c_code": "346",
                "c_name": "SVBC TTD",
                "c_lcn": "774",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566388983SVBC.png"
            },
            {
                "c_code": "387",
                "c_name": "GTPL BHAKTI",
                "c_lcn": "858",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566378850GTPL_BHAKTI.png"
            },
            {
                "c_code": "417",
                "c_name": "HARE KRSNA",
                "c_lcn": "520",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566307644HARE_KRSHNA.jpeg"
            }
        ],
        "ch_qt": "22"
    },
    {
        "genre_id_a": "9",
        "gen_name_a": "REGIONAL",
        "ch_list": [
            {
                "c_code": "321",
                "c_name": "PTC PUNJABI",
                "c_lcn": "727",
                "a_price": "0",
                "is_logo": "1",
                "logo_name": "1566476673PTC_PUNJABI.png"
            }
        ],
        "ch_qt": "1"
    }
]';
$json = json_decode($json,true);
foreach($json as $generi){
    foreach($generi['ch_list'] as $channel){
        $url = "http://packages.gtplkcbpl.com/assets/img/channellogo/".$channel['logo_name'];
       // echo $url;die();
        file_put_contents( "chlogo/".str_ireplace(array(" ","\/"),"",$channel['c_name']).'.jpg',file_get_contents($url));
    }
    
}
