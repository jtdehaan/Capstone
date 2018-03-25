package com.example.android.medconnect;

/**
 * Created by Jacob on 3/24/2018.
 */
import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;

import java.util.HashMap;
import java.util.Map;

public class AddSurveyRequest extends StringRequest {

    private static final String ADD_SURVEY_REQUEST_URL = "http://cgi.soic.indiana.edu/~team37/Add_Survey.php";
    private Map<String, String> params;

    public AddSurveyRequest(String SurveyName,String Question1,String Question2,String Question3,String Question4,String Question5, String ID,Response.Listener<String> listener){
        super(Method.POST, ADD_SURVEY_REQUEST_URL, listener, null);
        params = new HashMap<>();
        params.put("Surveyname", SurveyName);
        params.put("Question1", Question1);
        params.put("Question2", Question2);
        params.put("Question3", Question3);
        params.put("Question4", Question4);
        params.put("Question5", Question5);
        params.put("ID",ID);
    }

    @Override
    public Map<String, String> getParams() {
        return params;
    }
}