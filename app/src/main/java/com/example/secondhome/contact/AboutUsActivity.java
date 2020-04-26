package com.example.secondhome.contact;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.widget.TextView;

import com.example.secondhome.R;

public class AboutUsActivity extends AppCompatActivity {
    TextView title;
    TextView content1,content2,content3,content4;
    TextView quote1,quote2,quote3;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_about_us);
        title=(TextView) findViewById(R.id.contactTitle);
        content1=(TextView)findViewById(R.id.contactContent1);
        title.setText(R.string.aboutus);
        content1.setText("Se spune că adesea cei mai buni prieteni ai omului au 4 picioare. Din acest motiv, ne dorim să oferim tovarășilor noștri, mai mult sau mai puțin blănoși, cu sânge rece sau cu pene, cel mai de preț cadou: un cămin călduros și primitor alături de oameni iubitori.");

        content2=(TextView)findViewById(R.id.contactContent2);
        content2.setText("SecondHome este un proiect ce își propune să vină în sprijinul sufletelor neajutorate și, în plus, și a viitorilor sau actualilor lor stăpâni, printr-o platformă online ce pune la dispoziție o gamă de servicii pentru toți iubitorii de animale.");

        content3=(TextView)findViewById(R.id.contactContent3);
        content3.setText("Proiectul a luat naștere la inițiativa fondatoarei Bianca Pascu, care și-a materializat ideea cu ajutorul celor doi vizionari: Vlad și Andreea. Împreună, au pus cap la cap bazele unei companii ce nu doar că facilitează adopția, prin re-homing, ci și oferă cazare pentru animalele a căror stăpâni sunt temporar plecați din localitate.");


        quote1=(TextView)findViewById(R.id.contactQuote1);
        quote1.setText("Bianca:„ Lipsa unei astfel de platforme în viata mea de zi cu zi m-a împins să îmi doresc să înfintez un loc unde să pot să îmi las animalul când merg într-o vacanță sau, în cazul unei situații neprevăzute, să pot să îi găsesc animalului meu un cămin nou.”");

        quote2=(TextView)findViewById(R.id.contactQuote2);
        quote2.setText("Vlad:„Îmi doresc ca proiectul nostru să constituie un serviciu în primul rând pntru animale: să reducem rata abandonului și să reușim să găsim stăpâni alături de care să ducă o viață fericită cât mai multe dintre ele. ” ");

        quote3=(TextView)findViewById(R.id.contactQuote3);
        quote3.setText(" Andreea: „Este păcat că atât de multe animale ajung să fie abandonate din cauză că oamenii nu au timp să se ocupe de găsirea unui nou cămin pentru ele. Prin această platformă sper ca acest aspect să nu mai constituie un impediment în găsirea unui nou stăpân, iar posesorii de animale să vadă din ce în ce mai puțin abandonul ca pe o opțiune.”");


        content4=(TextView)findViewById(R.id.contactContent4);
        content4.setText("Astfel, a luat naștere lanțul de adăposturi la fel de prezent în online, precum și în toată țara. Acompaniat de o echipă energică, gata să răspundă la întrebări și să ofere ajutorul necesar, SecondHome creează o experiență unică în România, atât cu privire la procesul de re-homing, cât și pentru cazarea animalelor.");
    }
}
