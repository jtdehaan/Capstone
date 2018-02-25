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

public class OrganizationProfileEditActivity extends AppCompatActivity {

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
                Intent cancelEditIntent = new Intent(OrganizationProfileEditActivity.this, OrganizationProfileActivity.class);
                OrganizationProfileEditActivity.this.startActivity(cancelEditIntent);
            }
        });


        bConfirm.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final String name = etName.getText().toString();
                final String username = etUsername.getText().toString();
                //final String password = etPassword.getText().toString();
                final String email = etEmail.getText().toString();
                //final String confirmPassword = etConfirmPassword.getText().toString();

                SharedPreferences sharedPref = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                String user_id = sharedPref.getString("user_id", "");

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            /*if (!password.equals(confirmPassword)) {

                                AlertDialog.Builder builder2 = new AlertDialog.Builder(RegisterPatientActivity.this);
                                builder2.setMessage("Passwords do not match")
                                        .setNegativeButton("Retry", null)
                                        .create()
                                        .show();

                                // Toast.makeText(RegisterActivity.this, "Passwords do not match", Toast.LENGTH_SHORT).show();
                            }*/
                            // if{


                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");


                            if (success) {
                                Intent confirmEditIntent = new Intent(OrganizationProfileEditActivity.this, OrganizationProfileActivity.class);
                                OrganizationProfileEditActivity.this.startActivity(confirmEditIntent);

                                //String user_id = jsonResponse.getString("user_id");

                                SharedPreferences preferences = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                                //String user_id = preferences.getString("user_id", "");
                                SharedPreferences.Editor editor = preferences.edit();
                                editor.putString("name", name);
                                editor.putString("email", email);
                                editor.putString("username", username);
                                //editor.putString("user_id", user_id);
                                editor.apply();



                            } else {
                                AlertDialog.Builder builder = new AlertDialog.Builder(OrganizationProfileEditActivity.this);
                                builder.setMessage("Update Failed")
                                        .setNegativeButton("Retry", null)
                                        .create()
                                        .show();
                            }
                            //}
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                };

                EditOrganizationProfileRequest editOrganizationProfileRequest = new EditOrganizationProfileRequest(username, name, email, user_id, responseListener);
                RequestQueue queue = Volley.newRequestQueue(OrganizationProfileEditActivity.this);
                queue.add(editOrganizationProfileRequest);
            }
        });

    }
}
