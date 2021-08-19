<?php

defined('BASEPATH') OR exit('Acão não permitida');

class Ordem_servicos_model extends CI_Model
{
        public function get_all() 
        {
                $this->db->select
                        ([
                                'ordens_servicos.*',
                                'clientes.cliente_id',
                                'CONCAT (clientes.cliente_nome, " ", clientes.cliente_sobrenome) as cliente_nome',
                                'formas_pagamentos.forma_pagamento_id',
                                'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
                        ]);
                 $this->db->join('clientes', 'cliente_id = ordem_servico_cliente_id', 'LEFT');
                 $this->db->join('formas_pagamentos', 'forma_pagamento_id = ordem_servico_forma_pagamento_id', 'LEFT');

                 return $this->db->get('ordens_servicos')->result();
        }
    
       public function get_by_id($os_id = null) 
      {
            $this->db->select
                ([
                        'ordens_servicos.*',
                        'clientes.cliente_id',
                        'clientes.cliente_celular',
                        'clientes.cliente_cpf_cnpj',
                        'CONCAT (clientes.cliente_nome, " ", clientes.cliente_sobrenome) as cliente_nome',
                        'formas_pagamentos.forma_pagamento_id',
                        'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
                ]);

             $this->db->where('ordem_servico_id', $os_id);

             $this->db->join('clientes', 'cliente_id = ordem_servico_cliente_id', 'LEFT');
             $this->db->join('formas_pagamentos', 'forma_pagamento_id = ordem_servico_forma_pagamento_id', 'LEFT');

             return $this->db->get('ordens_servicos')->row();
      }
    
    
    public function get_all_servicos_by_ordem($os_id = null) 
    {
            if($os_id)
            {
                $this->db->select
                                           ([
                                                'ordem_tem_servicos.*',
                                                'servicos.servico_descricao',
                                           ]);
                 $this->db->join('servicos', 'servico_id = ordem_ts_id_servico', 'LEFT');
                 $this->db->where('ordem_ts_id_ordem_servico', $os_id);
                 
                 return $this->db->get('ordem_tem_servicos')->result();
            }
    }
    
    public function delete_old_services($os_id) 
    {
            if($os_id)
                $this->db->delete('ordem_tem_servicos', array('ordem_ts_id_ordem_servico' => $os_id));
    }
    
    public function get_all_servicos($os_id = null)
    {
            if($os_id)
            {
                    $this->db->select
                                            ([
                                                  'ordem_tem_servicos.*',  
                                                  'FORMAT(SUM(REPLACE(ordem_ts_valor_unitario, ",", "")),  2) as ordem_ts_valor_unitario',  
                                                  'FORMAT(SUM(REPLACE(ordem_ts_valor_total, ",", "")),  2) as ordem_ts_valor_total',
                                                  'servicos.servico_id',  
                                                  'servicos.servico_nome'
                                            ]);
                    
                     $this->db->join('servicos', 'servico_id = ordem_ts_id_servico', 'LEFT');
                     $this->db->where('ordem_ts_id_ordem_servico', $os_id);
                     
                     $this->db->group_by('ordem_ts_id_servico');
            }
            
            return $this->db->get('ordem_tem_servicos')->result();
    }
    
    public function get_valor_final_os($os_id = null) 
    {
            if($os_id)
            {
                    $this->db->select
                                            ([
                                                  'FORMAT(SUM(REPLACE(ordem_ts_valor_total, ",", "")),  2) as os_valor_total',
                                            ]);
                    
                     $this->db->join('servicos', 'servico_id = ordem_ts_id_servico', 'LEFT');
                     $this->db->where('ordem_ts_id_ordem_servico', $os_id);
            }
            
            return $this->db->get('ordem_tem_servicos')->row();
    }
}
