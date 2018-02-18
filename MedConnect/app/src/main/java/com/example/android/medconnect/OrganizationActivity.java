package com.example.android.medconnect;

import android.content.Intent;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
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
        final TextView tvAddEvent = (TextView) findViewById(R.id.tvAddEvent);

        Intent intent = getIntent();
        String name = intent.getStringExtra("name");

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
    }
}
