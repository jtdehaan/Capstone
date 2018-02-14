package com.example.android.medconnect;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

public class SelectionActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_selection);

        final Button bPatient = (Button) findViewById(R.id.bPatient);
        final Button bDoctor = (Button) findViewById(R.id.bDoctor);
        final Button bOrganization = (Button) findViewById(R.id.bOrganization);

        bPatient.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent loginPatientIntent = new Intent(SelectionActivity.this, LoginPatientActivity.class);
                SelectionActivity.this.startActivity(loginPatientIntent);
            }
        });

        bDoctor.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent loginDoctorIntent = new Intent(SelectionActivity.this, LoginDoctorActivity.class);
                SelectionActivity.this.startActivity(loginDoctorIntent);
            }
        });

        bOrganization.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent loginOrganizationIntent = new Intent(SelectionActivity.this, LoginOrganizationActivity.class);
                SelectionActivity.this.startActivity(loginOrganizationIntent);
            }
        });
    }
}
