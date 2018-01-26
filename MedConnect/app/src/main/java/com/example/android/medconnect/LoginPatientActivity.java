package com.example.android.medconnect;

import android.app.AlertDialog;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

public class LoginPatientActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login_patient);

        final EditText etUsername = (EditText) findViewById(R.id.etUsername);
        final EditText etPassword = (EditText) findViewById(R.id.etPassword);
        final Button bLogin = (Button) findViewById(R.id.bPatient);
        final TextView registerLink = (TextView) findViewById(R.id.tvRegister);

        registerLink.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent registerPatientIntent = new Intent(LoginPatientActivity.this, RegisterPatientActivity.class);
                LoginPatientActivity.this.startActivity(registerPatientIntent);
            }
        });

        /*
        bLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent calculatorIntent = new Intent(LoginActivity.this, CalculatorActivity.class);
                LoginActivity.this.startActivity(calculatorIntent);
            }
        });
        */


        bLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                final String username = etUsername.getText().toString();
                final String password = etPassword.getText().toString();

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {

                        try {
                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");

                            if (success) {
                                String name = jsonResponse.getString("name");

                                Intent patientIntent = new Intent(LoginPatientActivity.this, PatientActivity.class);
                                patientIntent.putExtra("name", name);
                                LoginPatientActivity.this.startActivity(patientIntent);
                            } else {
                                AlertDialog.Builder builder = new AlertDialog.Builder(LoginPatientActivity.this);
                                builder.setMessage("Login Failed")
                                        .setNegativeButton("Retry", null)
                                        .create()
                                        .show();
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                };

                LoginPatientRequest loginPatientRequest = new LoginPatientRequest(username, password, responseListener);
                RequestQueue queue = Volley.newRequestQueue(LoginPatientActivity.this);
                queue.add(loginPatientRequest);

            }
        });

    }
}