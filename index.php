<?php
require_once __DIR__ . '/vendor/autoload.php';

use Shuchkin\SimpleXLS;

$i = 0;
define('Component', $i++);
define('Template', $i++);
define('ImportComponent', $i++);
define('Data', $i++);
define('DV', $i++);
define('Props', $i++);
define('Emits', $i++);
define('Method', $i++);
define('MethodCode', $i++);
define('Computed', $i++);
define('ComputedCode', $i++);
define('Watch', $i++);
define('WatchCode', $i++);
define('State', $i++);
define('StateValue', $i++);
define('Mutation', $i++);
define('MutationCode', $i++);
define('Action', $i++);
define('ActionCode', $i++);
define('APImethod', $i++);
define('APIurl', $i++);
define('APIcode', $i++);
define('Service', $i++);
define('ServiceMethod', $i++);
define('ServiceMethodParams', $i++);
define('ServiceMethodCode', $i++);
define('ServicePrivateMethod', $i++);
define('ServicePrivateMethodParams', $i++);
define('ServicePrivateMethodCode', $i++);

class Component {

	private $name;
	private $components = [];
	private $template = '';
	private $data = [];
	private $props = [];
	private $emits = [];
	private $created = '';
	private $mounted = '';
	private $methods = [];
	private $computed = [];
	private $watch = [];

	public function __construct($name) {
		$this->name = $name;
	}

	public function setTemplate($template) {
		$this->template = $template;
	}

	public function addImportComponent($component) {
		$this->components[] = $component;
	}

	public function addData($data, $DV) {
		$this->data[$data] = $DV;
	}

	public function addProps($props) {
		$this->props[$props] = true;
	}

	public function addEmits($emits) {
		$this->emits[$emits] = true;
	}

	public function addMethod($method, $code) {
		if ($method === "mounted") {
			$this->mounted = $code;
		} elseif ($method === "created") {
			$this->created = $code;
		} else {
			$this->methods[$method] = $code;
		}
	}

	public function addComputed($computed, $code) {
		$this->computed[$computed] = $code;
	}

	public function addWatch($watch, $code) {
		$this->watch[$watch] = $code;
	}

	public function export() {
		return [
			'name' => $this->name,
			'components' => $this->components,
			'template' => $this->template,
			'data' => $this->data,
			'props' => $this->props,
			'emits' => $this->emits,
			'methods' => $this->methods,
			'mounted' => $this->mounted,
			'created' => $this->created,
			'computed' => $this->computed,
			'watch' => $this->watch
		];
	}

}

class Store {

	private $state = [];
	private $mutations = [];
	private $actions = [];

	public function addState($path, $value) {
		$this->state[$path] = $value;
	}

	public function addMutation($mutation, $code) {
		$this->mutations[$mutation] = $code;
	}

	public function addAction($action, $code) {
		$this->actions[$action] = $code;
	}

	public function export() {
		return [
			'state' => $this->state,
			'mutations' => $this->mutations,
			'actions' => $this->actions,
		];
	}

}


class Api {

	private $routes;

	public function addRoute($method, $url, $code) {
		$this->routes[] = [ 'method' => $method, 'url' => $url, 'code' => $code ];
	}

	public function export() {
		return ['routes' => $this->routes];
	}

}


class Services {

	private $services = [];

	public function addMethod($service, $method, $params, $code, $public) {
		if (!array_key_exists($service, $this->services)) {
			$this->services[$service] = [];
		}
		$this->services[$service][$method] = [$params, $code, $public];
	}

	public function exportServices() {
		return ['services' => array_keys($this->services)];
	}

	public function exportService($service) {
		return ['name' => $service, 'service' => $this->services[$service]];
	}

}


if ( $xls = SimpleXLS::parseFile(__DIR__ . '/vue-pokus.xls') ) {
	$data = $xls->rows();
} else {
	echo SimpleXLS::parseError();
}

unset($data[0]);

$components = [];
$store = new Store;
$api = new Api;
$services = new Services;

foreach ($data as $row) {
	if (!$row[Component]) continue;
	if (!array_key_exists($row[Component], $components)) {
		$components[$row[Component]] = new Component($row[Component]);
	}
	$component = $components[$row[Component]];

	if ($row[Template]) {
		$component->setTemplate($row[Template]);
	}

	if ($row[ImportComponent]) {
		$component->addImportComponent($row[ImportComponent]);
	}

	if ($row[Data] && $row[DV]) {
		$component->addData($row[Data], $row[DV]);
	}

	if ($row[Props]) {
		$component->addProps($row[Props]);
	}

	if ($row[Emits]) {
		$component->addEmits($row[Emits]);
	}

	if ($row[Method] && $row[MethodCode]) {
		$component->addMethod($row[Method], $row[MethodCode]);
	}

	if ($row[Computed] && $row[ComputedCode]) {
		$component->addComputed($row[Computed], $row[ComputedCode]);
	}

	if ($row[Watch] && $row[WatchCode]) {
		$component->addWatch($row[Watch], $row[WatchCode]);
	}

	if ($row[State] && $row[StateValue]) {
		$store->addState($row[State], $row[StateValue]);
	}

	if ($row[Mutation] && $row[MutationCode]) {
		$store->addMutation($row[Mutation], $row[MutationCode]);
	}

	if ($row[Action] && $row[ActionCode]) {
		$store->addAction($row[Action], $row[ActionCode]);
	}

	if ($row[APImethod] && $row[APIurl] && $row[APIcode]) {
		$api->addRoute($row[APImethod], $row[APIurl], $row[APIcode]);
	}

	if ($row[Service] && $row[ServiceMethod] && $row[ServiceMethodCode]) {
		$services->addMethod($row[Service], $row[ServiceMethod], $row[ServiceMethodParams], $row[ServiceMethodCode], 'public');
	}

	if ($row[Service] && $row[ServicePrivateMethod] && $row[ServicePrivateMethodCode]) {
		$services->addMethod($row[Service], $row[ServicePrivateMethod], $row[ServicePrivateMethodParams], $row[ServicePrivateMethodCode], 'private');
	}

}


$latte = new Latte\Engine;

foreach ($components as $name => $component) {
	file_put_contents(__DIR__ . '/front/src/components/' . $name . '.vue', $latte->renderToString(__DIR__ . '/component.latte', $component->export()));
}

file_put_contents(__DIR__ . '/front/src/store.js', $latte->renderToString(__DIR__ . '/store.latte', $store->export()));

file_put_contents(__DIR__ . '/back/app/routes.php', $latte->renderToString(__DIR__ . '/routes.latte', $api->export()));

file_put_contents(__DIR__ . '/back/src/Services/mf.php', $latte->renderToString(__DIR__ . '/mf.latte', $services->exportServices()));

foreach ($services->exportServices()['services'] as $service) {
	file_put_contents(__DIR__ . '/back/src/Services/' . $service . '.php', $latte->renderToString(__DIR__ . '/service.latte', $services->exportService($service)));
}