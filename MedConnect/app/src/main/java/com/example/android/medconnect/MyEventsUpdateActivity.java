package com.example.android.medconnect;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

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
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

public class MyEventsUpdateActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my_events_update);

        final EditText etEventName = (EditText) findViewById(R.id.etEventName);
        final EditText etLocation = (EditText) findViewById(R.id.etLocation);
        final EditText etTime = (EditText) findViewById(R.id.etTime);
        final EditText etPrice = (EditText) findViewById(R.id.etPrice);
        final EditText etDate = (EditText) findViewById(R.id.etDate);
        final EditText etDescription = (EditText) findViewById(R.id.etDescription);
        final Button bUpdateEvent = (Button) findViewById(R.id.bUpdateEvent);
        final Button bDeleteEvent = (Button) findViewById(R.id.bDeleteEvent);
        final TextView cancelLink = (TextView) findViewById(R.id.tvCancel);

        SharedPreferences sharedPref = getSharedPreferences("eventInfo", Context.MODE_PRIVATE);
        final String eventID = sharedPref.getString("eventID", "");
        final String shName = sharedPref.getString("name", "");
        final String shLocation = sharedPref.getString("location", "");
        final String shDate = sharedPref.getString("date", "");
        final String shTime = sharedPref.getString("time", "");
        final String shPrice = sharedPref.getString("price", "");
        final String shDescription = sharedPref.getString("description", "");

        etEventName.setText(shName);
        etLocation.setText(shLocation);
        etDate.setText(shDate);
        etTime.setText(shTime);
        etPrice.setText(shPrice);
        etDescription.setText(shDescription);

        cancelLink.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent cancelEditIntent = new Intent(MyEventsUpdateActivity.this, MyEventsActivity.class);
                MyEventsUpdateActivity.this.startActivity(cancelEditIntent);
            }
        });

        bUpdateEvent.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                final String name = etEventName.getText().toString();
                final String description = etDescription.getText().toString();
                final String location = etLocation.getText().toString();
                final String time = etTime.getText().toString();
                final String price = etPrice.getText().toString();
                final String date = etDate.getText().toString();

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");


                            if (success) {
                                Intent confirmUpdateIntent = new Intent(MyEventsUpdateActivity.this, MyEventsActivity.class);
                                MyEventsUpdateActivity.this.startActivity(confirmUpdateIntent);

                                //String user_id = jsonResponse.getString("user_id");

                                SharedPreferences preferences = getSharedPreferences("eventInfo", Context.MODE_PRIVATE);
                                //String user_id = preferences.getString("user_id", "");
                                SharedPreferences.Editor editor = preferences.edit();
                                editor.putString("name", name);
                                editor.putString("location", location);
                                editor.putString("date", date);
                                editor.putString("time", time);
                                editor.putString("price", price);
                                editor.putString("description", description);
                                editor.apply();

                                Toast.makeText(MyEventsUpdateActivity.this, "Successfully Updated Event", Toast.LENGTH_SHORT).show();



                            } else {
                                AlertDialog.Builder builder = new AlertDialog.Builder(MyEventsUpdateActivity.this);
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

                MyEventsUpdateRequest myEventsUpdateRequest = new MyEventsUpdateRequest(eventID, name, location, date, time, price, description, responseListener);
                RequestQueue queue = Volley.newRequestQueue(MyEventsUpdateActivity.this);
                queue.add(myEventsUpdateRequest);
            }
        });

        bDeleteEvent.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");


                            if (success) {
                                Intent confirmDeleteIntent = new Intent(MyEventsUpdateActivity.this, MyEventsActivity.class);
                                MyEventsUpdateActivity.this.startActivity(confirmDeleteIntent);

                                Toast.makeText(MyEventsUpdateActivity.this, "Successfully Deleted Event", Toast.LENGTH_SHORT).show();



                            } else {
                                AlertDialog.Builder builder = new AlertDialog.Builder(MyEventsUpdateActivity.this);
                                builder.setMessage("Delete Failed")
                                        .setNegativeButton("Retry", null)
                                        .create()
                                        .show();
                            }

                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                };

                MyEventsUpdateDeleteRequest myEventsUpdateDeleteRequest = new MyEventsUpdateDeleteRequest(eventID, responseListener);
                RequestQueue queue = Volley.newRequestQueue(MyEventsUpdateActivity.this);
                queue.add(myEventsUpdateDeleteRequest);

            }
        });

    }
}