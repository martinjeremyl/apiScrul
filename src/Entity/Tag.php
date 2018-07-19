<?php
/**
 * Created by PhpStorm.
 * User: jeremy martin
 * Date: 18/07/2018
 * Time: 20:21
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class tag
 * @package App\Entity
 * @ApiResource
 * @ORM\Entity
 */
class Tag
{
    /**
     * @var int The id of this tag.
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The name of the tag
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 2,
     *     max = 500,
     *     minMessage = "the tag name must be at least {{ limit }} characters long",
     *     maxMessage = "the tag name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $name;

    /**
     * @var string The description of the tag
     * @Assert\Length(
     *     max = 500,
     *     maxMessage = "the tag description cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var string The name of the subtask
     * @Assert\NotBlank
     * @Assert\Length(
     *     min = 2,
     *     max = 20,
     *     minMessage = "the tag color must be at least {{ limit }} characters long",
     *     maxMessage = "the tag color cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="text")
     */
    private $color;

}