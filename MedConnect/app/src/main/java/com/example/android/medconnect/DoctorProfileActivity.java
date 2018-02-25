package com.example.android.medconnect;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class DoctorProfileActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_doctor_profile);

        final TextView tvName = (TextView) findViewById(R.id.tvName);
        final TextView tvEmail = (TextView) findViewById(R.id.tvEmail);
        final TextView tvUsername = (TextView) findViewById(R.id.tvUsername);
        final Button bEdit = (Button) findViewById(R.id.bEdit);

        SharedPreferences sharedPref = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
        String name = sharedPref.getString("name", "");
        String email = sharedPref.getString("email", "");
        String username = sharedPref.getString("username", "");

        tvName.setText(name);
        tvEmail.setText("Email: " + email);
        tvUsername.setText("Username: " + username);

        /*bEdit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent editProfileIntent = new Intent(DoctorProfileActivity.this, DoctorProfileEditActivity.class);
                DoctorProfileActivity.this.startActivity(editProfileIntent);
            }});*/
    }
}
