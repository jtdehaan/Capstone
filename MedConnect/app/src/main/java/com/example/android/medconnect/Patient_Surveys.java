package com.example.android.medconnect;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.ListView;

public class Patient_Surveys extends AppCompatActivity {

    //PHP URL in order to access the required data from the database
    String urlAddress = "http://cgi.soic.indiana.edu/~team37/MySurveysPatient.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_patient__surveys);
        final ListView listView = (ListView) findViewById(R.id.lv);

        //Call on and execute the downloader with the provided URL
        MySurveysPatientDownloader mySurveyspatientDownloader = new MySurveysPatientDownloader(Patient_Surveys.this, urlAddress, listView);
        mySurveyspatientDownloader.execute();
    }
}
