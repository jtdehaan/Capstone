package com.example.android.medconnect;

import android.app.ProgressDialog;
import android.content.Context;
import android.os.AsyncTask;
import android.widget.ListView;
import android.widget.Toast;

import com.example.android.medconnect.EventsList;
import com.example.android.medconnect.EventsListAdapter;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

/**
 * Created by aator on 3/21/2018.
 */

public class EventsListParser extends AsyncTask<Void, Void, Integer> {

    Context c;
    ListView lv;
    String jsonData;

    ProgressDialog pd;
    ArrayList<EventsList> eventsLists = new ArrayList<>();

    public EventsListParser(Context c, ListView lv, String jsonData) {
        this.c = c;
        this.lv = lv;
        this.jsonData = jsonData;
    }

    @Override
    protected void onPreExecute() {
        super.onPreExecute();

        pd = new ProgressDialog(c);
        pd.setTitle("Parse");
        pd.setMessage("Parsing...Please wait");
        pd.show();
    }

    @Override
    protected Integer doInBackground(Void... params) {
        return this.parseData();
    }

    @Override
    protected void onPostExecute(Integer result) {
        super.onPostExecute(result);

        pd.dismiss();
        if (result == 0) {
            Toast.makeText(c, "Unable to parse", Toast.LENGTH_SHORT).show();
        } else {
            //CALL ADAPTER TO BIND DATA
            EventsListAdapter adapter = new EventsListAdapter(c, eventsLists);
            lv.setAdapter(adapter);
        }
    }

    private int parseData() {
        try {
            JSONArray ja = new JSONArray(jsonData);
            JSONObject jo = null;

            eventsLists.clear();
            EventsList s = null;

            for (int i = 0; i < ja.length(); i++) {
                jo = ja.getJSONObject(i);

                int id = jo.getInt("EventID");
                String name = jo.getString("name");
                String location = jo.getString("location");
                String date = jo.getString("date");
                String time = jo.getString("time");
                String price = jo.getString("price");
                String description = jo.getString("description");
                String attendance = jo.getString("attendance");

                s = new EventsList();
                s.setId(id);
                s.setName(name);
                s.setLocation(location);
                s.setDate(date);
                s.setTime(time);
                s.setPrice(price);
                s.setDescription(description);
                s.setAttendance(attendance);

                eventsLists.add(s);
            }

            return 1;


        } catch (JSONException e) {
            e.printStackTrace();
        }

        return 0;
    }
}