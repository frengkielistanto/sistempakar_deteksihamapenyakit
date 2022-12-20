package com.sistempakar.spk;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.sistempakar.spk.Adapter.Adapter_Gejala;
import com.sistempakar.spk.Adapter.Adapter_Hasil;
import com.sistempakar.spk.Model.Gejala_Model;
import com.sistempakar.spk.Model.Hasil_Model;
import com.sistempakar.spk.config.AppController;
import com.sistempakar.spk.config.ServerAccess;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class HasilActivity extends AppCompatActivity {
    ProgressDialog pd;
    private Adapter_Hasil adapter;
    private List<Hasil_Model> list;
    private RecyclerView listdata;
    RecyclerView.LayoutManager mManager;
    Button button3;
    LinearLayout lndatakosong;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_hasil);
        Intent data = getIntent();

        listdata = (RecyclerView)findViewById(R.id.listdata);
        button3 = findViewById(R.id.button3);
        lndatakosong = findViewById(R.id.datakosong);
        listdata.setHasFixedSize(true);
        list = new ArrayList<>();
        adapter = new Adapter_Hasil(this,(ArrayList<Hasil_Model>) list, this);
        mManager = new LinearLayoutManager(this,LinearLayoutManager.VERTICAL,false);
        listdata.setLayoutManager(mManager);
        listdata.setAdapter(adapter);
        pd = new ProgressDialog(this);
        hitung(data.getStringExtra("kode"),data.getStringExtra("cfuser"));

    }
    private void hitung(String kode, String cfuser){
//        final String sa= saran.getText().toString().trim();

            pd.show();
            StringRequest stringRequest = new StringRequest(
                    Request.Method.POST,
                    ServerAccess.KONSULTASI+"hasil",
                    new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            pd.dismiss();
                            JSONObject res = null;
                            try {
                                Log.d("hasil", response);
                                JSONObject obj = new JSONObject(response);
                                res = new JSONObject(response);
                                JSONArray arr = res.getJSONArray("result");
//                                JSONArray arr = jo.getJSONArray("info");
                                if(arr.length() > 0) {
                                    for (int i = 0; i < arr.length(); i++) {
                                        try {
                                            JSONObject data = arr.getJSONObject(i);
                                            Hasil_Model md = new Hasil_Model();
                                            md.setKode(data.getString("id"));
                                            md.setPenyakit(data.getString("penyakit"));
                                            String gejala = data.getString("gejala").replace(',', '\n');
                                            String solusi = data.getString("solusi").replace('.', '\n');
                                            md.setGejala(gejala);
                                            md.setJenis(data.getString("jenis"));
                                            md.setPresentase(data.getString("probabilitas"));
                                            md.setSolusi(solusi);
                                            md.setSemuagejala(data.getString("semuagejala"));
                                            list.add(md);
                                        } catch (Exception ea) {
                                            ea.printStackTrace();
                                            Log.d("pesan", ea.getMessage());
                                        }
                                    }
                                    adapter.notifyDataSetChanged();
                                }else{
                        lndatakosong.setVisibility(View.VISIBLE);
                                    Toast.makeText(getBaseContext(), "Data Kosong", Toast.LENGTH_SHORT).show();
                                }
                            } catch (JSONException e) {
                                Toast.makeText(
                                        getBaseContext(),
                                        e.getMessage(),
                                        Toast.LENGTH_LONG
                                ).show();
                                e.printStackTrace();
                            }
                        }
                    },
                    new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            pd.dismiss();
                            Toast.makeText(
                                    getBaseContext(),
                                    "error",
                                    Toast.LENGTH_LONG
                            ).show();
                        }
                    }
            ) {
                @Override
                protected Map<String, String> getParams() throws AuthFailureError {
                    Map<String, String> params = new HashMap<>();
                    params.put("pilihan", kode.toString());
                    params.put("cfuser", cfuser.toString());
                    Log.d("params",params.toString());
                    return params;
                }
            };
            AppController.getInstance().addToRequestQueue(stringRequest);
        }
    }
