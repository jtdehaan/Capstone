package com.example.android.medconnect;

import android.content.Intent;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
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

        Intent intent = getIntent();
        String name = intent.getStringExtra("name");

        tvName.setText(name);

        tvProfile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent patientProfileIntent = new Intent(PatientActivity.this, PatientProfileActivity.class);
                PatientActivity.this.startActivity(patientProfileIntent);
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
    }
}
