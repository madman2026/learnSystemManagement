<?php

namespace Modules\User\Enums;

enum UserStatusEnum: string
{
    case PENDING='pending';
    case ACTIVE='active';
    case DEACTIVE='deactive';
}
