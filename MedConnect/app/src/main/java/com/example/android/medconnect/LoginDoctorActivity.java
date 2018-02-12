package com.example.android.medconnect;

import android.app.AlertDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
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

public class LoginDoctorActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login_doctor);

        final EditText etUsername = (EditText) findViewById(R.id.etUsername);
        final EditText etPassword = (EditText) findViewById(R.id.etPassword);
        final Button bLogin = (Button) findViewById(R.id.bPatient);
        final TextView registerLink = (TextView) findViewById(R.id.tvRegister);

        registerLink.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent registerDoctorIntent = new Intent(LoginDoctorActivity.this, RegisterDoctorActivity.class);
                LoginDoctorActivity.this.startActivity(registerDoctorIntent);
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
                                String email = jsonResponse.getString("email");
                                String username = jsonResponse.getString("username");

                                SharedPreferences preferences = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                                SharedPreferences.Editor editor = preferences.edit();
                                editor.putString("name", name);
                                editor.putString("email", email);
                                editor.putString("username", username);
                                editor.apply();

                                Intent doctorIntent = new Intent(LoginDoctorActivity.this, DoctorActivity.class);
                                doctorIntent.putExtra("name", name);
                                LoginDoctorActivity.this.startActivity(doctorIntent);

                                etUsername.setText("");
                                etPassword.setText("");
                            } else {
                                AlertDialog.Builder builder = new AlertDialog.Builder(LoginDoctorActivity.this);
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

                LoginDoctorRequest loginDoctorRequest = new LoginDoctorRequest(username, password, responseListener);
                RequestQueue queue = Volley.newRequestQueue(LoginDoctorActivity.this);
                queue.add(loginDoctorRequest);

            }
        });

    }
}
