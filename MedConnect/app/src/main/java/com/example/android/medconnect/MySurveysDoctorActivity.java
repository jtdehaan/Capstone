package com.example.android.medconnect;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.ListView;

public class MySurveysDoctorActivity extends AppCompatActivity {

    String urlAddress = "";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my_surveys_doctor);
        final ListView lv = (ListView) findViewById(R.id.lv);

        //GET USER_ID & PLACE IN URL
        SharedPreferences sharedPref = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
        final String DoctorID = sharedPref.getString("user_id", "");

        //urlAddress = "http://cgi.soic.indiana.edu/~team37/MySurveysDoctor.php/?DoctorID=" + DoctorID;
        urlAddress = "http://cgi.soic.indiana.edu/~team37/MySurveysDoctor.php/?DoctorID=31";

        MySurveysDoctorDownloader d = new MySurveysDoctorDownloader(MySurveysDoctorActivity.this, urlAddress, lv);
        d.execute();
    }
}