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

public class OrganizationActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_organization);

        //Set the name TextView to the name from the logged in user
        final TextView tvName = (TextView) findViewById(R.id.tvName);
        final TextView tvProfile = (TextView) findViewById(R.id.tvProfile);
        final TextView tvMyEvents = (TextView) findViewById(R.id.tvMyEvents);
        final TextView tvAllEvents = (TextView) findViewById(R.id.tvAllEvents);
        final Button bLogout = (Button) findViewById(R.id.bLogout);
        final TextView tvAddEvent = (TextView) findViewById(R.id.tvAddEvent);

        SharedPreferences sharedPref = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
        String name = sharedPref.getString("name", "");

        tvName.setText("Hello " + name);

        tvProfile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent organizationProfileIntent = new Intent(OrganizationActivity.this, OrganizationProfileActivity.class);
                OrganizationActivity.this.startActivity(organizationProfileIntent);
            }
        });
        tvAddEvent.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent organizationAddEventIntent = new Intent(OrganizationActivity.this,Add_Event_Activity.class);
                OrganizationActivity.this.startActivity(organizationAddEventIntent);
            }
        });

        //Set timer for 15 minutes
        Handler handler=new Handler();
        handler.postDelayed(new Runnable() {
            @Override
            public void run() {
                Intent registerIntent = new Intent(OrganizationActivity.this, LoginOrganizationActivity.class);
                OrganizationActivity.this.startActivity(registerIntent);
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

                Intent logoutIntent = new Intent(OrganizationActivity.this, SelectionActivity.class);
                OrganizationActivity.this.startActivity(logoutIntent);
            }});
    }
}
