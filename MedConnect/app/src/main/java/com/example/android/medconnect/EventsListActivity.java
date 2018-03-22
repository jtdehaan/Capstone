package com.example.android.medconnect;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ListView;
import com.example.android.medconnect.EventsListDownloader;

public class EventsListActivity extends AppCompatActivity {

    String urlAddress="http://cgi.soic.indiana.edu/~team37/Event_List.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_events_list);
        final ListView lv= (ListView) findViewById(R.id.lv);


        EventsListDownloader d=new EventsListDownloader(EventsListActivity.this,urlAddress,lv);
        d.execute();
    }
}
