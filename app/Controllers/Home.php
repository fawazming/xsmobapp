<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('index');
    }

    public function serp()
    {
        
        $ser = $this->llama3($this->request->getPost('que'));
        // dd($ser);
        echo view('serp', ['res'=>$ser]);
    }
    public function rqur()
    {
        $client = service('curlrequest');
        $sv = $this->request->getGet('sv');
        
        try {
            $response = $client->get('https://cdn.islamic.network/quran/images/' . $sv . '.png');
            
            if ($response->getStatusCode() !== 200) {
                return $this->errorResponse('Image not found', 404);
            }

            // Set headers for image response
            header('Content-Type: image/png');
            echo $response->getBody();
            echo "<a href='".base_url('rqur?sv=62_3')."' style='color:red;'>NEXT</a>";
            exit;
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve image: ' . $e->getMessage(), 500);
        }
    }

    private function llama3($prompt, $maxTokens = 100, $temperature = 0.5)
    {
        $client = service('curlrequest');

        $headers = [
            'Authorization' => 'Bearer ' . $_ENV['AI'],
            'Content-Type' => 'application/json',
        ];

        // $body = [
        //     'prompt' => $prompt,
        //     'max_tokens' => $maxTokens,
        //     'temperature' => $temperature,
        // ];

        $body = [
            "messages" => [
                  [
                     "role" => "user", 
                     "content" => $prompt 
                  ] 
               ], 
            "model" => "llama3-8b-8192" 
         ]; 

        $response = $client->post('https://api.groq.com/openai/v1/chat/completions', ['headers' => $headers, 'json' => $body]);
        // dd($client);
        if ($response->getStatusCode() == 200) {
            $responseData = json_decode($response->getBody(), true);
            return $responseData['choices'][0]['message']['content'];
        } else {
            return 'Error: ' . $response->getStatusCode();
        }
    }
}
