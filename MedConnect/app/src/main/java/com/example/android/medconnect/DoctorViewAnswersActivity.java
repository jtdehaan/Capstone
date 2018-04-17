package com.example.android.medconnect;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.ListView;

public class DoctorViewAnswersActivity extends AppCompatActivity {

    String urlAddress = "";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_doctor_view_answers);
        final ListView listView = (ListView) findViewById(R.id.lv);

        //Get user ID and place in URL
        SharedPreferences sharedPref = getSharedPreferences("SurveyInfo", Context.MODE_PRIVATE);
        final String SurveyID = sharedPref.getString("SurveyID", "");

        //PHP URL in order to access the required data from the database
        urlAddress = "http://cgi.soic.indiana.edu/~team37/Survey_Answers.php/?SurveyID=" + SurveyID;

        //Call on and execute the downloader with the provided URL
        DoctorViewAnswersDownloader doctorViewAnswersDownloader = new DoctorViewAnswersDownloader(DoctorViewAnswersActivity.this, urlAddress, listView);
        doctorViewAnswersDownloader.execute();
    }
}
