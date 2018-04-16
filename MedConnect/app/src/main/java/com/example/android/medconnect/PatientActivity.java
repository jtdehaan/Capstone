package com.example.android.medconnect;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class PatientActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_patient);

        //Set the name TextView to the name from the logged in user
        final TextView tvName = (TextView) findViewById(R.id.tvName);
        final TextView tvProfile = (TextView) findViewById(R.id.tvProfile);
        final TextView tvSurvey = (TextView) findViewById(R.id.tvSurvey);
        final TextView tvEvent = (TextView) findViewById(R.id.tvEvent);
        final Button bLogout = (Button) findViewById(R.id.bLogout);

        SharedPreferences sharedPref = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
        String name = sharedPref.getString("name", "");

        tvName.setText("Hello " + name);

        tvProfile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent patientProfileIntent = new Intent(PatientActivity.this, PatientProfileActivity.class);
                PatientActivity.this.startActivity(patientProfileIntent);
            }
        });

        tvEvent.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent patientEventIntent = new Intent(PatientActivity.this, PatientEventsActivity.class);
                PatientActivity.this.startActivity(patientEventIntent);
            }
        });

        tvSurvey.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent patientSurveyIntent = new Intent(PatientActivity.this, Patient_Surveys.class);
                PatientActivity.this.startActivity(patientSurveyIntent);
            }
        });


        //Set timer for 15 minutes
        Handler handler=new Handler();
        handler.postDelayed(new Runnable() {
            @Override
            public void run() {
                Intent registerIntent = new Intent(PatientActivity.this, LoginPatientActivity.class);
                PatientActivity.this.startActivity(registerIntent);
            }
        },900000L);

        //logout button
        bLogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                SharedPreferences preferences = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                SharedPreferences.Editor editor = preferences.edit();
                editor.clear();
                editor.apply();

                Intent logoutIntent = new Intent(PatientActivity.this, SelectionActivity.class);
                PatientActivity.this.startActivity(logoutIntent);
            }});
    }
}
