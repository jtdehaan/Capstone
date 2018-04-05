package com.example.android.medconnect;

import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

public class MyEventsUpdateRequest extends StringRequest {

    private static final String EDIT_DOCTOR_PROFILE_REQUEST_URL = "http://cgi.soic.indiana.edu/~team37/Events_Update.php";
    private Map<String, String> params;

    public MyEventsUpdateRequest(String eventID, String name, String location, String date, String time, String price, String description, Response.Listener<String> listener){
        super(Method.POST, EDIT_DOCTOR_PROFILE_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("EventID", eventID);
        params.put("name", name);
        params.put("location", location);
        params.put("date", date);
        params.put("time", time);
        params.put("price", price);
        params.put("description", description);
    }

    @Override
    public Map<String, String> getParams() {
        return params;
    }
}