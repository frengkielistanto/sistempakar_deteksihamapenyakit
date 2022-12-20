package com.sistempakar.spk.Adapter;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.Switch;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;

import com.sistempakar.spk.Model.Gejala_Model;
import com.sistempakar.spk.Model.Penyakit_Model;
import com.sistempakar.spk.R;

import java.util.ArrayList;

public class Adapter_Penyakit extends RecyclerView.Adapter<Adapter_Penyakit.ViewHolder>  {
    private ArrayList<Penyakit_Model> listdata;
    private Activity activity;
    private Context context;
    private OnSwitchClick onSwitchClick;

    public Adapter_Penyakit(Activity activity, ArrayList<Penyakit_Model> listdata, Context context) {
        this.listdata = listdata;
        this.activity = activity;
        this.context = context;
//        this.onCLickYes = onCLickYes;
    }
    public interface OnSwitchClick{
        void OnSwitchClick(int position);
    }
    public void setOnSwitchClick(OnSwitchClick onSwitchClick){
        this.onSwitchClick = onSwitchClick;
    }

    @Override
    public Adapter_Penyakit.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View v = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.template_penyakit, parent, false);
        Adapter_Penyakit.ViewHolder vh = new Adapter_Penyakit.ViewHolder(v);
        return vh;
    }
    @SuppressLint("RecyclerView")
    @Override
    public void onBindViewHolder(Adapter_Penyakit.ViewHolder holder, final int position) {
        int posisi = position;
        Penyakit_Model md = listdata.get(position);
        holder.kode.setText(listdata.get(position).getKode());
        holder.nama.setText(listdata.get(position).getNama());
        holder.kode.setVisibility(View.GONE);
        holder.mContext = context;

    }
    @Override
    public int getItemCount() {
        return listdata.size();
    }
    public static class ViewHolder extends RecyclerView.ViewHolder {
        private TextView kode, nama;
        Context mContext;
        ImageView cover;
        public ViewHolder(View v) {
            super(v);
            kode=(TextView)v.findViewById(R.id.kode);
            nama=(TextView)v.findViewById(R.id.name);
            v.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    try {
//                        Intent intent;
//                        Log.d("data", String.valueOf(choice.isChecked()));
//                        intent = new Intent(v.getContext(), Detail_Makanan.class);
//                        intent.putExtra("kode", kode.getText().toString());
//                        v.getContext().startActivity(intent);
                    } catch (Exception e) {
                        Log.d("pesan", "error");
                    }
                }
            });
        }
    }
}