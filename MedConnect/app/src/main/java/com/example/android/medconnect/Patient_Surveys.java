package com.example.android.medconnect;

import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.widget.ListView;

public class Patient_Surveys extends AppCompatActivity {

    String urlAddress = "";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_patient__surveys);
        final ListView listView = (ListView) findViewById(R.id.lv);

        //GET USER_ID & PLACE IN URL
        SharedPreferences sharedPref = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
        final String PatientID = sharedPref.getString("user_id", "");

        urlAddress = "http://cgi.soic.indiana.edu/~team37/MySurveysPatient.php";
        //urlAddress = "http://cgi.soic.indiana.edu/~team37/MySurveysDoctor.php/?DoctorID=31";

        MySurveysPatientDownloader mySurveyspatientDownloader = new MySurveysPatientDownloader(Patient_Surveys.this, urlAddress, listView);
        mySurveyspatientDownloader.execute();
    }
}
