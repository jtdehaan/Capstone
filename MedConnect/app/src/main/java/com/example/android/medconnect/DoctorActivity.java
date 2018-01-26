package com.example.android.medconnect;

import android.content.Intent;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;

public class DoctorActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_doctor);

        //Set the name TextView to the name from the logged in user
        final TextView tvName = (TextView) findViewById(R.id.tvName);

        Intent intent = getIntent();
        String name = intent.getStringExtra("name");

        tvName.setText(name);

        //Set timer for 15 minutes
        Handler handler=new Handler();
        handler.postDelayed(new Runnable() {
            @Override
            public void run() {
                Intent registerIntent = new Intent(DoctorActivity.this, LoginDoctorActivity.class);
                DoctorActivity.this.startActivity(registerIntent);
            }
        },900000L);
    }
}
