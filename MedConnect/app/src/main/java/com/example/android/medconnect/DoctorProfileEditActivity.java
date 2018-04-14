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

public class DoctorProfileEditActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_patient_profile_edit);

        final EditText etName = (EditText) findViewById(R.id.etName);
        final EditText etUsername = (EditText) findViewById(R.id.etUsername);
        final EditText etEmail = (EditText) findViewById(R.id.etEmail);
        final Button bConfirm = (Button) findViewById(R.id.bConfirm);
        final TextView cancelLink = (TextView) findViewById(R.id.tvCancel);

        cancelLink.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent cancelEditIntent = new Intent(DoctorProfileEditActivity.this, DoctorProfileActivity.class);
                DoctorProfileEditActivity.this.startActivity(cancelEditIntent);
            }
        });

        SharedPreferences sharedPref = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
        String shName = sharedPref.getString("name", "");
        String shEmail = sharedPref.getString("email", "");
        String shUsername = sharedPref.getString("username", "");

        etName.setText(shName);
        etUsername.setText(shUsername);
        etEmail.setText(shEmail);


        bConfirm.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final String name = etName.getText().toString();
                final String username = etUsername.getText().toString();
                final String email = etEmail.getText().toString();

                SharedPreferences sharedPref = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                String user_id = sharedPref.getString("user_id", "");

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");


                            if (success) {
                                Intent confirmEditIntent = new Intent(DoctorProfileEditActivity.this, DoctorProfileActivity.class);
                                DoctorProfileEditActivity.this.startActivity(confirmEditIntent);

                                SharedPreferences preferences = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                                SharedPreferences.Editor editor = preferences.edit();
                                editor.putString("name", name);
                                editor.putString("email", email);
                                editor.putString("username", username);
                                editor.apply();



                            } else {
                                AlertDialog.Builder builder = new AlertDialog.Builder(DoctorProfileEditActivity.this);
                                builder.setMessage("Update Failed: Username or Email has already been registered")
                                        .setNegativeButton("Retry", null)
                                        .create()
                                        .show();
                            }

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                };

                EditDoctorProfileRequest editDoctorProfileRequest = new EditDoctorProfileRequest(username, name, email, user_id, responseListener);
                RequestQueue queue = Volley.newRequestQueue(DoctorProfileEditActivity.this);
                queue.add(editDoctorProfileRequest);
            }
        });

    }
}
