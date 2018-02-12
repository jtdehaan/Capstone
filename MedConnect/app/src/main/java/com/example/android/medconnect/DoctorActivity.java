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

public class DoctorActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_doctor);

        //Set the name TextView to the name from the logged in user
        final TextView tvName = (TextView) findViewById(R.id.tvName);
        final TextView tvProfile = (TextView) findViewById(R.id.tvProfile);
        final TextView tvPatients = (TextView) findViewById(R.id.tvPatients);
        final TextView tvEvents = (TextView) findViewById(R.id.tvEvents);
        final Button bLogout = (Button) findViewById(R.id.bLogout);

        Intent intent = getIntent();
        String name = intent.getStringExtra("name");

        tvName.setText("Hello " + name);

        tvProfile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent doctorProfileIntent = new Intent(DoctorActivity.this, DoctorProfileActivity.class);
                DoctorActivity.this.startActivity(doctorProfileIntent);
            }
        });

        //Set timer for 15 minutes
        Handler handler=new Handler();
        handler.postDelayed(new Runnable() {
            @Override
            public void run() {
                SharedPreferences preferences = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                SharedPreferences.Editor editor = preferences.edit();
                editor.clear();
                editor.apply();

                Intent registerIntent = new Intent(DoctorActivity.this, LoginDoctorActivity.class);
                DoctorActivity.this.startActivity(registerIntent);
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

                Intent logoutIntent = new Intent(DoctorActivity.this, SelectionActivity.class);
                DoctorActivity.this.startActivity(logoutIntent);
            }});

        /*
        //this method will logout the user
    public void logout() {
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.clear();
        editor.apply();
        mCtx.startActivity(new Intent(mCtx, LoginActivity.class));
    }
         */
    }
}
