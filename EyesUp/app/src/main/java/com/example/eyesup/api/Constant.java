package com.example.eyesup.api;

public class Constant {

    public static final int USER_IS_NOT_EXISTED = 0;
    public static final int WRONG_NAME_OR_PASSWORD = 1;
    public static final int USER_IS_EXISTED_AND_VERIFIED = 2;


    public static final String CAFES_CATEGORY_SET = "9376,9376002,7315147,9376006";
    public static final String RADIUS_1KM = "1000";
    public static final String RADIUS_500METERS = "500";

    //tomtom api url search
    //key=, lat=, lon=, categorySet=, radius=
    public static final String MAPS_API_REQUEST_NEARBY_CAFES = "https://api.tomtom.com/search/2/nearbySearch/.JSON?";


    //database system domain ip config must be changed for each network to connect the application
    // meem network: 192.168.8.110
    // meme4g network: 192.168.1.24
    //future work find an online database server
    public static final String USER_REGISTER_URL = "http://192.168.1.24/driver-api/index.php?type=register";
    public static final String USER_LOGIN_URL = "http://192.168.1.24/driver-api/index.php?type=login";
    public static final String USER_VERIFY_URL = "http://192.168.1.24/driver-api/index.php?type=verify-user";
    public static final String USER_UPDATE_URL = "http://192.168.1.24/driver-api/index.php?type=update-user";

}
