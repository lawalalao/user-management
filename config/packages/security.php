// config/packages/security.php
use App\Entity\User;

$container->loadFromExtension('security', array(
'encoders' => array(
User::class => 'bcrypt',
),
));