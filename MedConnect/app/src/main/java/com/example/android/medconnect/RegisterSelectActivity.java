package com.example.android.medconnect;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class RegisterSelectActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register_select);

        final Button bPatient = (Button) findViewById(R.id.bPatient);
        final Button bDoctor = (Button) findViewById(R.id.bDoctor);
        final Button bOrganization = (Button) findViewById(R.id.bOrganization);

        bPatient.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent registerPatientIntent = new Intent(RegisterSelectActivity.this, RegisterPatientActivity.class);
                RegisterSelectActivity.this.startActivity(registerPatientIntent);
            }
        });

        bDoctor.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent registerDoctorIntent = new Intent(RegisterSelectActivity.this, RegisterDoctorActivity.class);
                RegisterSelectActivity.this.startActivity(registerDoctorIntent);
            }
        });

        bOrganization.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent registerOrganizationIntent = new Intent(RegisterSelectActivity.this, RegisterOrganizationActivity.class);
                RegisterSelectActivity.this.startActivity(registerOrganizationIntent);
            }
        });
    }
}
