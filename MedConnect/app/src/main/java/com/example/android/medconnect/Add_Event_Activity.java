package com.example.android.medconnect;

import android.app.AlertDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
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

public class Add_Event_Activity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add__event_);

        final EditText etEventName = (EditText) findViewById(R.id.etEventName);
        final EditText etLocation = (EditText) findViewById(R.id.etLocation);
        final EditText etPhone = (EditText) findViewById(R.id.etPhone);
        final EditText etEmail = (EditText) findViewById(R.id.etEmail);
        final EditText etTimes = (EditText) findViewById(R.id.etTimes);
        final EditText etPrice = (EditText) findViewById(R.id.etPrice);
        final Button bRegister = (Button) findViewById(R.id.bCreateSurvey);
        final TextView cancelLink = (TextView) findViewById(R.id.tvCancel);

        cancelLink.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent registerAddEventIntent = new Intent(Add_Event_Activity.this, OrganizationActivity.class);
                Add_Event_Activity.this.startActivity(registerAddEventIntent);
            }
        });

        bRegister.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final String EventName = etEventName.getText().toString();
                final String Location = etLocation.getText().toString();
                final String Phone = etPhone.getText().toString();
                final String Email = etEmail.getText().toString();
                final String Times = etTimes.getText().toString();
                final String Price = etPrice.getText().toString();

                SharedPreferences preferences = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
                final String ID = preferences.getString("user_id","1");

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                                JSONObject jsonResponse = new JSONObject(response);
                                boolean success = jsonResponse.getBoolean("success");
                                if (success) {
                                    Intent addEventIntent = new Intent(Add_Event_Activity.this, OrganizationActivity.class);
                                    Add_Event_Activity.this.startActivity(addEventIntent);
                                } else {
                                    AlertDialog.Builder builder = new AlertDialog.Builder(Add_Event_Activity.this);
                                    builder.setMessage("Registration Failed")
                                            .setNegativeButton("Retry", null)
                                            .create()
                                            .show();
                                }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                };

                AddEventRequest addEventRequest = new AddEventRequest(EventName, Location, Phone, Email, Times, Price,ID, responseListener);
                RequestQueue queue = Volley.newRequestQueue(Add_Event_Activity.this);
                queue.add(addEventRequest);

            }
        });
    }
}