<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Carro;

class HomeController extends Controller
{

    

    public function index(){
        return view('home',[]);
    }

    public function formSubmit(Request $request){
        $carrosArray = [];

        $termo = $request->input('termo');

        $url = file_get_contents('https://www.questmultimarcas.com.br/estoque?termo='.trim($termo));

        preg_match_all('/<article[\s\S]*?article>/im',$url,$array);
        
        
        foreach($array[0] as $el1){
            $el1 = strval($el1);

            preg_match('/www.[\s\S]*?\/\d{4}\/\d{1,}/',$el1,$carroLink);
            $carroLink = $carroLink[0];

            preg_match('/[A-Z][\s\S]*?</',$el1,$carroNome);
            $carroNome = $carroNome[0];
            
            preg_match('/<!-- Car Details -->[\s\S]*?Car Details -->/im',$el1,$details);
            
            $detailsString = strval($details[0]);
            
            // dd($detailsString);
            
            
            preg_match_all('/<li[\s\S]*?li>/im',$detailsString,$liArray);
            
            $liAno = strval($liArray[0][0]);
            
            $liQuilometro = strval($liArray[0][1]);
            
            $liCombustivel = strval($liArray[0][2]);
            
            $liCambio = strval($liArray[0][3]);
            
            $liPortas = strval($liArray[0][4]);
            
            $liCor = strval($liArray[0][5]);
            
            
            //pegando o ano do primeiro article
            preg_match('/\d{4}/',$detailsString,$carroAno);
            $carroAno = $carroAno[0];
            
            //pegando a quilometragem do primeiro article
            $seteDigitos = preg_match('/(\d{3}\.\d{3})/im',$liQuilometro);
            $seisDigitos = preg_match('/(\d{2}\.\d{3})/im',$liQuilometro);
            $umDigito = preg_match('/(\d)/im',$liQuilometro);
            
            if($seteDigitos == 1){
                preg_match('/(\d{3}\.\d{3})/im',$liQuilometro,$carroKm);
            }
            else if($seisDigitos == 1){
                preg_match('/(\d{2}\.\d{3})/im',$liQuilometro,$carroKm);
            }
            else if($umDigito == 1){
                preg_match('/(\d)/im',$liQuilometro,$carroKm);
            }
            
            $carroKm = $carroKm[0];
            
            //pegando o combustível do article
            preg_match('/(Diesel)/im',$liCombustivel,$carroCombustivel);
            if(count($carroCombustivel) == 0){
                preg_match('/(Gasolina)/im',$liCombustivel,$carroCombustivel);
                if(count($carroCombustivel) == 0){
                    preg_match('/(Flex)/im',$liCombustivel,$carroCombustivel);
                    if(count($carroCombustivel) == 0){
                        preg_match('/(Elétrico)/im',$liCombustivel,$carroCombustivel);
                    }
                }
            }
            
            $carroCombustivel = $carroCombustivel[0];

            //pegando cambio do article
            preg_match('/(Automático)/im',$liCambio,$carroCambio);
            if(count($carroCambio) == 0){
                preg_match('/(Manual)/im',$liCambio,$carroCambio);
            }

            $carroCambio = $carroCambio[0];

            //pegando portas do article
            preg_match('/\d\sportas/im',$liPortas,$carroPortas);

            $carroPortas = $carroPortas[0];

            //pegando cor do article
            preg_match('/[A-Z][a-z]*\s/m',$liCor,$carroCor);

            $carroCor = $carroCor[0];

            $carroArray = array($carroAno,$carroKm,$carroCombustivel,$carroCambio,$carroPortas,$carroCor,$carroLink,$carroNome);

            array_push($carrosArray,$carroArray);


            
        }

        //salvar no BD
        $carro = new Carro;

        $carro->nome_veiculo = $carroNome;
            $carro->link = $carroLink;
            $carro->ano = $carroAno;
            $carro->combustivel = $carroCombustivel;
            $carro->portas = $carroPortas;
            $carro->quilometragem = $carroKm;
            $carro->cambio = $carroCambio;
            $carro->cor = $carroCor;

        $user = auth()->user();
        $carro->user_id = $user->id;

        $carro->save();
        dd($carrosArray);

        return redirect('/home')->with('msg','caiu na function : '.trim($url).trim($c1));
    }


    public function destroy($id){
        Carro::destroy($id);

        return redirect('/home')->with('msg','Carro excluído');
    }

}
