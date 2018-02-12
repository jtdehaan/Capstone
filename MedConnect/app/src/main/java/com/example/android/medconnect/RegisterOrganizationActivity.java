package com.example.android.medconnect;

import android.app.AlertDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

public class RegisterOrganizationActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register_organization);

        final EditText etUsername = (EditText) findViewById(R.id.etUsername);
        final EditText etPassword = (EditText) findViewById(R.id.etPassword);
        final EditText etName = (EditText) findViewById(R.id.etName);
        final EditText etEmail = (EditText) findViewById(R.id.etEmail);
        final EditText etConfirmPassword = (EditText) findViewById(R.id.etConfirmPassword);
        final Button bRegister = (Button) findViewById(R.id.bRegister);
        final TextView cancelLink = (TextView) findViewById(R.id.tvCancel);

        cancelLink.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent registerPatientIntent = new Intent(RegisterOrganizationActivity.this, LoginOrganizationActivity.class);
                RegisterOrganizationActivity.this.startActivity(registerPatientIntent);
            }
        });

        bRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final String name = etName.getText().toString();
                final String username = etUsername.getText().toString();
                final String password = etPassword.getText().toString();
                final String email = etEmail.getText().toString();
                final String confirmPassword = etConfirmPassword.getText().toString();

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            if (!password.equals(confirmPassword)) {

                                AlertDialog.Builder builder2 = new AlertDialog.Builder(RegisterOrganizationActivity.this);
                                builder2.setMessage("Passwords do not match")
                                        .setNegativeButton("Retry", null)
                                        .create()
                                        .show();

                                // Toast.makeText(RegisterActivity.this, "Passwords do not match", Toast.LENGTH_SHORT).show();
                            } else {


                                JSONObject jsonResponse = new JSONObject(response);
                                boolean success = jsonResponse.getBoolean("success");


                                if (success) {
                                    Intent registerOrganizationIntent = new Intent(RegisterOrganizationActivity.this, LoginOrganizationActivity.class);
                                    RegisterOrganizationActivity.this.startActivity(registerOrganizationIntent);
                                } else {
                                    AlertDialog.Builder builder = new AlertDialog.Builder(RegisterOrganizationActivity.this);
                                    builder.setMessage("Registration Failed")
                                            .setNegativeButton("Retry", null)
                                            .create()
                                            .show();
                                }
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                };

                RegisterOrganizationRequest registerOrganizationRequest = new RegisterOrganizationRequest(username, password, name, email, responseListener);
                RequestQueue queue = Volley.newRequestQueue(RegisterOrganizationActivity.this);
                queue.add(registerOrganizationRequest);
            }
        });
    }
}