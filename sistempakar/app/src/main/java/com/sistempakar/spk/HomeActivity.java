package com.sistempakar.spk;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.sistempakar.spk.Adapter.Adapter_Gejala;
import com.sistempakar.spk.Adapter.Adapter_Penyakit;
import com.sistempakar.spk.Model.Gejala_Model;
import com.sistempakar.spk.Model.Penyakit_Model;
import com.sistempakar.spk.config.AppController;
import com.sistempakar.spk.config.ServerAccess;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class HomeActivity extends AppCompatActivity {
    ImageView home, konsultasi, info;
    private Adapter_Penyakit adapter;
    private List<Penyakit_Model> list;
    private RecyclerView listdata;
    RecyclerView.LayoutManager mManager;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);
        home = findViewById(R.id.home);
        konsultasi = findViewById(R.id.konsultasi);
        info = findViewById(R.id.info);
        home.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(getBaseContext(), HomeActivity.class));
            }
        });
        konsultasi.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(getBaseContext(), KonsultasiActivity.class));
            }
        });
        info.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(getBaseContext(), InfoActivity.class));
            }
        });
        listdata = (RecyclerView)findViewById(R.id.listdata);
        listdata.setNestedScrollingEnabled(false);
        listdata.setHasFixedSize(true);
        list = new ArrayList<>();
        adapter = new Adapter_Penyakit(this,(ArrayList<Penyakit_Model>) list, this);
        mManager = new LinearLayoutManager(this,LinearLayoutManager.VERTICAL,false);

        listdata.setLayoutManager(mManager);
        listdata.setAdapter(adapter);
        loadJson();
    }
    private void loadJson()
    {
        String link = ServerAccess.PENYAKIT;
        StringRequest senddata = new StringRequest(Request.Method.GET, link, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    JSONArray arr = res.getJSONArray("data");
                    if(arr.length() > 0) {
                        for (int i = 0; i < arr.length(); i++) {
                            try {
                                JSONObject data = arr.getJSONObject(i);
                                Penyakit_Model md = new Penyakit_Model();
                                md.setKode(data.getString("id"));
                                md.setNama((i+1)+". "+data.getString("nama_pkt"));
                                list.add(md);
                            } catch (Exception ea) {
                                ea.printStackTrace();
                                Log.d("pesan", ea.getMessage());
                            }
                        }
                        adapter.notifyDataSetChanged();
                    }else{
//                        not_found.setVisibility(View.VISIBLE);
                        Toast.makeText(getBaseContext(), "Data Kosong", Toast.LENGTH_SHORT).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(getBaseContext(), "Data Kosong", Toast.LENGTH_SHORT).show();
                    Log.d("pesan", "error "+e.getMessage());
                    e.printStackTrace();
                }
            }
        },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getBaseContext(), "Data Kosong", Toast.LENGTH_SHORT).show();
                        Log.d("volley", "errornya : " + error.getMessage());
                    }
                });
        AppController.getInstance().addToRequestQueue(senddata);
    }
}