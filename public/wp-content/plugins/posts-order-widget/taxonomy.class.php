<?php

class POW_Taxonomy {
	//Partie publique
	private $type		= "";
	private $slug;
	private $firstQuery	= TRUE;
	private $selection	= "";
	const POW_DEFAUT	= "dated";
	
	//Partie admin - Modification des catégories and co.
	private $types;
	const POW_OPT_NAME = "pow_default_order";
	
	private $options;
	
	public function __construct(){
		//Liste des types de taxonomie autorisées à trier les données (http://codex.wordpress.org/Taxonomies)
		$this->types = array('category', 'post_tag');
		
		//Chargement du formulaire d'edition
		if(is_admin() && isset( $_GET['taxonomy'] ) && in_array($_GET['taxonomy'], $this->types))add_action( $_GET['taxonomy'] . '_edit_form', array( $this, 'backend_initialiser' ), 10, 1 );
		
		//Mise à jour des données
		add_action( 'edit_term', array( $this, 'update_term' ), 99, 3 );
		
		//Liste des différents tris possible
		$this->options = array();
		$this->options["title"] 	= __('By title', 'post-order-widget');
		$this->options["dated"] 	= __('Newest to oldest', 'post-order-widget');
		$this->options["datea"] 	= __('Oldest to newest', 'post-order-widget');
		$this->options["modified"] 	= __('By modification', 'post-order-widget');
		$this->options["rand"] 		= __('Randomly', 'post-order-widget');
		
		//delete_option(POW_OPT_NAME);
	}
	
	public function getHTMLOptions(){
		$options = array();
		
		foreach(array_keys($this->options) as $type){
			$options[] = $this->getHTMLOption($type);
		}
		
		return implode("\n", $options);
	}
	
	public function getHTMLOption($type){
		$html = "";
		
		if(array_key_exists($type, $this->options)){
			$libelle = $this->options[$type];
			$selected = $type == $this->selection ? ' selected="selected"' : "";
			
			$html = "<option value=\"$type\"$selected>$libelle</option>";
		}
		
		return $html;
	}
	
	/**
	* Cette méthode n'est utilisée que dans la partie publique.
	* Elle sert à modifier la première requête, la principale, afin d'y modifier l'ordre des articles.
	* Elle sert aussi à initialiser des attributs de cette classe qui sera utilisée pour charger le widget (si ce dernier a été ajouté).
	* 
	* @param WP_Query $vars
	* 
	* @return WP_Query
	*/
	public function frontend_initialiser($vars){
		
		//Requête modifiable uniquement pour la toute première requête SQL.
		if(is_main_query() && $this->firstQuery){
			$this->firstQuery = FALSE;
			
			//On récupère la sélection de l'utilisateur
			$this->selection = isset($_GET['pow']) ? $_GET['pow'] : "";
			
			//Calcul du type (uniquement ceux gérés par l'extension) de taxonomie en cours.
			if(is_category()){
				$this->type = "category";
			}elseif(is_tag()){
				$this->type = "post_tag";
			}
			
			//Si le type est géré par l'extension, on récupère le slug courant.
			if($this->type != '')$this->slug = $vars->query_vars[$this->type . "_name"];
			
			//Le visiteur n'a pas demandé à changer le tri.
			if($this->selection == ''){
				
				//Par défaut, on garde le tri par défaut.
				$this->selection = self::POW_DEFAUT;
				
				//Maintenant, on va regarder si le tri par défaut ne serait pas différent de celui définit nativement
				if($this->slug != ''){
					//On récupère le différentes conf pour les différents type de taxonomie
					$terms = $this->select_term($this->type);
					
					//On regarde si l'admin a changé le tri par défaut.
					if(array_key_exists($this->type, $terms) && array_key_exists($this->slug, $terms[$this->type]))$this->selection = $terms[$this->type][$this->slug];
				}
				
			}
			
			//On termine par modifier la clause ORDER BY de la requête.
			switch ($this->selection) {
				
				//Sélection par défaut : Tri du plus récent au plus ancien
				case 'dated':
					$orderby = "date";
					$order = "DESC";

					break;
				
				//Tri du plus ancien au plus récent
				case 'datea':
					$orderby = "date";
					$order = "ASC";

					break;
				
				//Tri du plus ancien au plus récent
				case 'title':
					$orderby = "title";
					$order = "ASC";

					break;
				
				//Pour les cas simples, la valeur de l'item de la combo correspond à ce qui sera utilisé dans le "order by" de la requête SQL.
				default:
					$orderby = $this->selection;
					$order = "DESC";
					
			}
			
			//On applique le filtre
			$vars->set('orderby', $orderby);
			$vars->set('order', $order);
		}
		
		return $vars;
	}
	
	/**
	* Appelée via callback (doit donc rester public) lors de la modification d'une catégorie (ou autre taxonomie).
	* Sert à charger le formulaire concernant notre extension
	* 
	* @param stdClass $term
	* 
	* @return
	*/
	public function backend_initialiser($term){
		//On récupère les précédentes données
		$tax_meta = $this->select_term($term->taxonomy);
		
		//Initialisation des attributs de la classe
		$this->slug = $term->slug;
		$this->selection = $tax_meta[$term->taxonomy][$term->slug] == '' ? self::POW_DEFAUT : $tax_meta[$term->taxonomy][$term->slug];
		
		//On récupère toutes les options au format HTML
		$options = $this->getHTMLOptions();
		
		//On charge le formulaire qui concerne l'extension
		echo '
		<table class="form-table">
			<tr class="form-field">
				<th scope="row" valign="top"><label for="pow">' . __('Sort posts', 'post-order-widget') . '</label></th>
				<td>
					<select name="pow" id="pow" class="postform">
						' . $options . '
					</select>
				</td>
			</tr>
		</table>
		';
	}
	
	/**
	* A utiliser pour récupérer les données sauvegardées précédemment.
	* 
	* @param string $tax_type Type de taxonomie auquel appartient la taxonomie
	* 
	* @return Array
	*/
	public function select_term($tax_type = ""){
		//Lecture des données de notre extension.
		$retour = get_option( POW_OPT_NAME );
		
		//Création du tableau de données s'il n'y en a pas encore.
		if($retour === FALSE)$retour = array();
		
		//Création de la taxonomie si cette dernière n'existe pas.
		if($taxonomy != "" && !array_key_exists($tax_type, $retour))$retour[$tax_type] = array();
		
		return $retour;
	}
	
	/**
	* Sauvegarde de la sélection.
	* 
	* @param int    $term_id  ID of the term to save data for
	* @param int    $tt_id    The taxonomy_term_id for the term.
	* @param string $tax_type Type de taxonomie auquel appartient la taxonomie
	*/
	public function update_term($term_id, $tt_id, $tax_type){
		$term = get_term_by('id', $term_id, $tax_type);
		
		//On récupère les précédentes données
		$tax_meta = $this->select_term($tax_type);
		
		//Tri par défaut choisi
		$tax_meta[$tax_type][$term->slug] = $_POST['pow'];
		
		//Sauvegarde
		update_option( POW_OPT_NAME, $tax_meta, 99 );
	}
	
	public function getType(){
		return $this->type;
	}
	
	public function getSlug(){
		return $this->slug;
	}
	
	public function setSlug($slug){
		$this->slug = $slug;
	}
	
}

?>