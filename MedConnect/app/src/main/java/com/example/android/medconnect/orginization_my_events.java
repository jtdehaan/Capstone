package com.example.android.medconnect;

import android.app.AlertDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

public class orginization_my_events extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_orginization_my_events);
        String[] events ={"1","2","3"};
        ArrayAdapter<String> adapter = new ArrayAdapter<String>(this,android.R.layout.simple_list_item_1,events);

        ListView listView = (ListView) findViewById(R.id.events);
        listView.setAdapter(adapter);

        SharedPreferences preferences = getSharedPreferences("userInfo", Context.MODE_PRIVATE);
        final String ID = preferences.getString("user_id","1");

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {

                            JSONObject jsonResponse = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");

                            if (success) {
                                Intent addEventIntent = new Intent(orginization_my_events.this, OrganizationActivity.class);
                                orginization_my_events.this.startActivity(addEventIntent);
                            } else {
                                AlertDialog.Builder builder = new AlertDialog.Builder(orginization_my_events.this);
                                builder.setMessage("Loading Failed")
                                        .setNegativeButton("Retry", null)
                                        .create()
                                        .show();
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                };

                MyEventsRequest viewEventRequest = new MyEventsRequest(ID,responseListener);
                RequestQueue queue = Volley.newRequestQueue(orginization_my_events.this);
                queue.add(viewEventRequest);
        ;
    }
}
