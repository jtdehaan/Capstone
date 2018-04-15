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
        final ListView listView = (ListView) findViewById(R.id.lv);

        //Get user ID and place in URL
        SharedPreferences sharedPref = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
        final String DoctorID = sharedPref.getString("user_id", "");

        //PHP URL in order to access the required data from the database
        urlAddress = "http://cgi.soic.indiana.edu/~team37/MySurveysDoctor.php/?DoctorID=" + DoctorID;

        //Call on and execute the downloader with the provided URL
        MySurveysDoctorDownloader mySurveysDoctorDownloader = new MySurveysDoctorDownloader(MySurveysDoctorActivity.this, urlAddress, listView);
        mySurveysDoctorDownloader.execute();
    }
}