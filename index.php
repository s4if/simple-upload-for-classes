<?php
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Slim\Views\PhpRenderer;
use \Aura\Sql\ExtendedPdo;
use \Aura\SqlQuery\QueryFactory;
use \Slim\Flash\Messages;

require 'vendor/autoload.php';

// Starting Session
if (!session_id()) {
    @session_start();
}

$app = new \Slim\App;
$container = $app->getContainer();
$container['renderer'] = new PhpRenderer("./views");
$container['database'] = new ExtendedPdo('sqlite:data/register.sqlite');
$container['queryBuilder'] = new QueryFactory('sqlite');
$container['flash'] = new Messages();

$app->get('/', function (Request $request, Response $response) {
    $messages = $this->flash->getMessages();
    $flash_messages = null;
    if (!empty($messages)) {
        $flash_messages = '<div class="alert alert-danger alert-dismissible" role="alert">'.
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
            '<span aria-hidden="true">&times;</span></button>'.
            $messages['success'][0].'</div>';
    }
    return $this->renderer->render($response, "/index.php", [
        'url' => $request->getUri()->getBaseUrl() . '/',
        'flash_messages' => $flash_messages,
    ]);
});

$app->post('/uploading', function (Request $request, Response $response) {
    $db = $this->database;
    $qb = $this->queryBuilder;

    $now = time();
    
    $files = $request->getUploadedFiles();
    $postData = $request->getParsedBody();
    if (empty($files['file_upload'])) {
        return $response->getBody->write('upload gagal karena gakada file!');
    } else {
        $uploadDir = "/home/s4if/Workspaces/PHP/slim/data/" . $postData['kelas'] . '/';
        $upload = $files['file_upload'];
        if ($upload->getError() === UPLOAD_ERR_OK) {
            $name = $upload->getClientFilename();
            $select = $qb->newSelect();
            $select->cols(['count(filename) as jml'])
                ->from('upload_log')
                ->where('filename = ?', $name);
            $result = $db->fetchOne($select->getStatement(), $select->getBindValues());
            if ($result['jml'] > 0) {
                $name = $now . '-' . $name;
            }
            $upload->moveTo($uploadDir . $name);
             // Inserting to upload log
            $insert = $qb->newInsert();
            $insert->into('upload_log')
                ->cols([
                    'nama_1' => $_POST['nama_1'],
                    'nama_2' => $_POST['nama_2'],
                    'kelas' => $_POST['kelas'],
                    'filename' => $name,
                    'waktu' => $now,
                ]);
            $result = $db->fetchAll($insert->getStatement(), $insert->getBindValues());
            $this->flash->addMessage('success', 'Upload Berhasil');
            return $response->withRedirect($request->getUri()->getBaseUrl().'/lihat');
        } else {
            $this->flash->addMessage('failure', 'Upload Berhasil');
            return $response->withRedirect($request->getUri()->getBaseUrl().'/');
        }
    }
});

$app->get('/lihat[/{kelas}]', function (Request $request, Response $response, $args) {
    $messages = $this->flash->getMessages();
    $flash_messages = null;
    if (!empty($messages)) {
        $flash_messages = '<div class="alert alert-success alert-dismissible" role="alert">'.
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'.
            '<span aria-hidden="true">&times;</span></button>'.
            $messages['success'][0].'</div>';
    }
    $kelas = '';
    if (!empty($args['kelas'])) {
        $kelas = '/' . $args['kelas'];
    }
    return $this->renderer->render($response, "/lihat.php", [
        'url' => $request->getUri()->getBaseUrl() . '/',
        'flash_messages' => $flash_messages,
        'ajax_url' => $request->getUri()->getBaseUrl() . '/lihat_ajax' . $kelas
        ]);
});

$app->post('/lihat_ajax[/{kelas}]', function (Request $request, Response $response, $args) {
    $db = $this->database;
    $qb = $this->queryBuilder;
    $select = $qb->newSelect();
    $select->cols(['*'])->from('upload_log');
    if (!empty($args['kelas'])) {
        $select->where('kelas = ?', strtoupper($args['kelas']));
    }
    $uploaders = $db->fetchAll($select->getStatement(), $select->getBindValues());
    $data = [];
    foreach ($uploaders as $uploader) {
        $row = [];
        $row[] = $uploader['id'];
        $row[] = $uploader['kelas'];
        $row[] = $uploader['nama_1'];
        $row[] = $uploader['nama_2'];
        $row[] = $uploader['filename'];
        $date = new DateTime();
        $date->setTimestamp($uploader['waktu']);
        $row[] = $date->format('l, d-M-y H:i:s T');
        $data[] = $row;
    }
    return $response->withJson(['data' => $data]);
});

$app->run();
