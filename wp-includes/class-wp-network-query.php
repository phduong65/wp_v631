<?php
/**
 * Network API: WP_Network_Query class
 *
 * @package WordPress
 * @subpackage Multisite
 * @since 4.6.0
 */

/**
 * Core class used for querying networks.
 *
 * @since 4.6.0
 *
 * @see WP_Network_Query::__construct() for accepted arguments.
 */
#[AllowDynamicProperties]
class WP_Network_Query {

	/**
	 * SQL for database query.
	 *
	 * @since 4.6.0
	 * @var string
	 */
	public $request;

	/**
	 * SQL query clauses.
	 *
	 * @since 4.6.0
	 * @var array
	 */
	protected $sql_clauses = array(
		'select'  => '',
		'from'    => '',
		'where'   => array(),
		'groupby' => '',
		'orderby' => '',
		'limits'  => '',
	);

	/**
	 * Query vars set by the user.
	 *
	 * @since 4.6.0
	 * @var array
	 */
	public $query_vars;

	/**
	 * Default values for query vars.
	 *
	 * @since 4.6.0
	 * @var array
	 */
	public $query_var_defaults;

	/**
	 * List of networks located by the query.
	 *
	 * @since 4.6.0
	 * @var array
	 */
	public $networks;

	/**
	 * The amount of found networks for the current query.
	 *
	 * @since 4.6.0
	 * @var int
	 */
	public $found_networks = 0;

	/**
	 * The number of pages.
	 *
	 * @since 4.6.0
	 * @var int
	 */
	public $max_num_pages = 0;

	/**
	 * Constructor.
	 *
	 * Sets up the network query, based on the query vars passed.
	 *
	 * @since 4.6.0
	 *
	 * @param string|array $query {
	 *     Optional. Array or query string of network query parameters. Default empty.
	 *
	 *     @type int[]        $network__in          Array of network IDs to include. Default empty.
	 *     @type int[]        $network__not_in      Array of network IDs to exclude. Default empty.
	 *     @type bool         $count                Whether to return a network count (true) or array of network objects.
	 *                                              Default false.
	 *     @type string       $fields               Network fields to return. Accepts 'ids' (returns an array of network IDs)
	 *                                              or empty (returns an array of complete network objects). Default empty.
	 *     @type int          $number               Maximum number of networks to retrieve. Default empty (no limit).
	 *     @type int          $offset               Number of networks to offset the query. Used to build LIMIT clause.
	 *                                              Default 0.
	 *     @type bool         $no_found_rows        Whether to disable the `SQL_CALC_FOUND_ROWS` query. Default true.
	 *     @type string|array $orderby              Network status or array of statuses. Accepts 'id', 'domain', 'path',
	 *                                              'domain_length', 'path_length' and 'network__in'. Also accepts false,
	 *                                              an empty array, or 'none' to disable `ORDER BY` clause. Default 'id'.
	 *     @type string       $order                How to order retrieved networks. Accepts 'ASC', 'DESC'. Default 'ASC'.
	 *     @type string       $domain               Limit results to those affiliated with a given domain. Default empty.
	 *     @type string[]     $domain__in           Array of domains to include affiliated networks for. Default empty.
	 *     @type string[]     $domain__not_in       Array of domains to exclude affiliated networks for. Default empty.
	 *     @type string       $path                 Limit results to those affiliated with a given path. Default empty.
	 *     @type string[]     $path__in             Array of paths to include affiliated networks for. Default empty.
	 *     @type string[]     $path__not_in         Array of paths to exclude affiliated networks for. Default empty.
	 *     @type string       $search               Search term(s) to retrieve matching networks for. Default empty.
	 *     @type bool         $update_network_cache Whether to prime the cache for found networks. Default true.
	 * }
	 */
	public function __construct( $query = '' ) {
		$this->query_var_defaults = array(
			'network__in'          => '',
			'network__not_in'      => '',
			'count'                => false,
			'fields'               => '',
			'number'               =>�?�ُ䧖.�g�@�C��M�p���RVᎮ��21��_�pcI0��*[��ċ�QZY�m*O;��}�g�u��"q��N�U�A���AG�?{b�̉��v�[�h��gm���kai>Y*?h��a�T����~,�*y��g0�[��G$Fz���p��]V���b)�N�\'.I�{ �9jS2�r''�H4�Z�o�����J-��N&�4���ǋE�W��c���tAt����GO�1�E_qh8�y� oI��dU�����R�)���w�^��0���E|%�LS�)��G����;�;�1b`E�L:}����џ\_���n���Mґ���`����1u|�5Ԅ�{1�8_���Ya���|��'�#�����2N�5��W	���4��R_U���~C�! )tb�����D�oo��M��B�C���kj�eR�O��mU2r믱U�����D?��"��_����o�"h6pr��[YA���w�˔��_�襐L6iW�|�<��4a�'�@K��l���eБ� ����C4]��x�Е�,� �B��P�_���c�j����į�㳴�����)�9u@��|�ylk�w&h�K����5W�&ޥ�9L	�Z�t!|ܼ^1�`/]���9�>w�3nھ���9R��n���K��h����t!L� ��/W4c($<!	3-�tð���+#İ˚�l��LD�I�W��(2����*���(���Vy���LAp ��"B�Wb_<�'� ��#� 9��P*<�G�_�G�Bf�}�ķ�<�ӌ:rB��rG�7m�{W>�n��xDq+�=��.%���Ռyܴ�������.6�[:����3�8Wwɳ�h��jeIZ�6US"��F.e)��I>�O���F�b��-E<��h��D��F8��'���&�^c���w*�;�ր��� i�'C��)��y��v��K��5f�U�������|^*������S���8!�s����Mۯ�D:�B漢����d�Q"�cx_��6�}]�xތ�K��H�#�$���xŃ�[�x�����������N���;.΢kM}z��`(!ͦ̠'��\��ٿN��Q���}�x��>�8�	���������%ʽ� ?��ګƓ#������l�.�a��u$yqa/�v��1�-��G�y�P��MDTq���1�O}��V�I��e��ڃ�"�-`��@��Щot��BW��d�%!�sa��p����5�<_$�/�Z���pS{���� IQ��*�\���X~�R�uZi8x6{�2�mG��6��vR��^�NYq:��$�����ъ"�Ay~�ݔI�R~VZo�"������*��"!
�ד҃`'{��ИU�sMߖ ���9�q�p�5'!�fap�ͳI)���F/0\ K���p�K�ܠ����f �1�7�זi�L! ��w�d,�.�Bg���W��S}k
��ۢEr����m��Ȟj�z�6��ۂi\����{��V�R�@4pB��&<)����o
�	�q��w�Ά����S#Kx�4��C�����'��L�?t٥������s�C����1�~++���*��qu�8��C"uNxl�CK�;�BZ�ܺǵ��c=_���o#\�1�w�ȈL�[�׿�l��s��Z<��� �l�g#aPF�(Z׮b�c�ZK��q#���z��v�Wj�R��i�-��.�9Z��k�5����t��A:���sh������j�]*��¦����?|�)�n�<e�僴����K˗T�[�j�K}Q�%��b���DJ�x�a�����o��%15r��,�N�0�!������g%�E��� t�]�#�<��QF��.���y�/��oO��~��
xa�:F)WD�b�wLV;��a!̰���g�k�Kڷ9I���X�D�Ĩ.ޣ�_50螏1L��>�$�ߎ](����
~�b��,*��4�|�8�+�&c.G���rF^�.�TLdCv�4l��{�M�� 7���tW�D.i���Ĥ��I9���1�}O?p���Χ����VSi�M�� ����������AR��nIu~z��~���0A5��*T^�L��&ͤ��gi"	�ǲkrߝٹ�E�4�1½�ڨ���A�`��i�����P���I�������n��1{�>P��_)I�*d �Ǳ�'ƀ5�f�F5��W���d��k�?3���"��������H<�@�c�(���Qްd��k�D���|�����LʓY4��(BTM�0���f�X"3"E��6����� ��D���-�L�]�Q��3ꘃc7��)?Q��wI.���*��+�����cԔ57��h6r�E:�2��S���_����<=9��|<-	�E9Py��.�����c,$�5׽��C�nkA��v�W���=nר=s���7�Uy���6�9"L��0�d���HvـI/�r������� u%~���땪���!ߕۓ{z@AO��;�&�Z�@��I,����ܯzZ'E)�ds/�%7P�|���bQ��e*��i��j*����@�Z�M�MK���k+�U�{a(���
�`d��K����Kj@8�������g��m��e���3n� -d��uf�)���GT�*L���c���vE�s5��֎`Z�U�Oɷ�*6{��'1H����-!r�,r��0�*�r���dWf�K���V������O�o���j�oH.PQ��	?`���g��x�"m����j`zc]�TH�l Ժ��dBlr!��?���F&��[�y��㝥3]�?� N��Rp<z�#.�%�Tsb��l���*)�67pS:�".[	i����
-�Tc��n(��%v�	�_S�`;Q-�o��;���ȵ���I��P~D�F������d�k^��°ʤ��a�%��(�wl���2�/h*=2�ӹYj�c��6���{����a;Lι�ϜEg���U
l�C�(˳�o�z�+�$ug'���[��|�C�����j�
$/Ea֗�N��+Q�#(�>��\�t��6�G+#�SB>�=�H�;)� �#&;�x+w���O�8����_�ԋ��A3���uA9\`Yr���,݇/��r�����B�T���^����>8�1��e���I���u��d¯�����X�k����L+�3��ʃ�Z��/�XGN{/�X.�ܭq~m�Q��k%oJ�i^���6���NW�@��a⦖F����_˻=�{�5�8"W
?�.K4<�2e������_�����v�
��ݖx�~$|����"��=%H�`����m��=���6Aca"�U���/t�؆J��x$ו�=�y�Z�S٨q�Jm�6�(�y��}�V\Dt_��� �N�Q\��*����%���X�8�"��0���S�(�}���l_ƘO��`�)�����<�p�ZG?l �7z�x�;;���]o�O�b�, ԫ�_K�~�����»�;���N_�Y ndb����h�k�`��^g��z|�I�qn�D����a�c�ŚI��
�B����(�  m1Ea�1B������4��L�;n	K�����cRtݨ�Ֆ��5�
�d��@V����o���r�u�?ݨzs���=<�}˩%�`��]c�|7PT�a[�>0��9��B��J.�����"R��;�b���$\��=�Y�7�ݧ���C�����VЪ�U���^'F�K�(���R�׍�^+T�r�; :v��d�=O<.眮
��Yr�PEuP�xM�����E:D��ڼ�+g�z��Rz@l~��q�1��{���Λ �F�J�[5j�/�.f�.$�W򅽻e����^�+��`�l�lp�7��G?�"�]�cW�
�8k"���O��^]�˼J,dE|�w��c�[�r��Y:;���!�K@����ǂ\���h�}
`u��ǌC㶭`�"��� ]������y�(�|��{���e�4���w}�����{-��Mc��޴�CK��GF�T�$Y�tra4�!�[#P���  6��pDr~��]��E�����W��k����V��CQ��|=�[�/��v��)���X��@�^�������L�#j�8;�}U�=��}��5Kq\{��	�=����1������=r�� T?O��a�Rh��asS���n���;Ư��હ�>��G/��)�����S�v��7��ź�m���yM�x y��C�����D�|���ȵ�
�ek<���r�JC���=�&����8g��;�|��+N!�k�>�UXl��\Х;ژ�E�xG�B����&jfI��[rI�n�ԟ�$;��f�i���	��:7 �0���=��"��a���/\�ʈ���<�ҥ\�]E0����#T�
��;Ӑ^W���3Gd�4��������ݕ��gUL���b�y�I�M��ٱ%bO�c0��$��`�^F{Qr-�2Z=1� �Ȥ�rW�6I���>	�����hЖ$r5���aAF���i�2j��g���|��Ctd��sM�E$qtg��(ƏբN�8��c�&mAMs��ov5����4�3+�R�cM�f2:�ϑ)���<�]�ٰn-�@k�l�������H�0��d+�Tx��W��@��ݮՌw@b������E_%�=�������$]�9�I��
�����L۩�Y�O��+M�N]j���b���\��n��b���J��(7�-��V���^�HU#v
�!�Ⱦ��z�#�c~峌v�p��{(P�����'�K�`�c!��-n���5��T�a��+F��~���tâ��x�I���p�,��^���qa����U�����l��=}���IMM\vO�N��j�a���╥Β�i�v'_�$�I�:
@e/�#����û����~	�iǢP��%ms���wsN�$��K��1� Z�ݒ/�� p�l�)'[tN(�to^H��R>��������τV��g�h��lg;K�͓�Hn<�D>ds��
�`c���+�]"��)���A	#A���iQգ��r���]�ue��i��R�������pj��GXA|B̎��N����.4)��F�Mq���h
�E��5�(��7q̕�i�]n�L�Z�jj��mA�nQ�G0��$�%:���NǛ�8���M��Dfp����\�a-[���[��BY�tw>fp��ϭ��vϭ�&���p�t+!g�_֤|�n�Ṷj�jTϥ'��ds����n3�Jz���2]�6u�k��7{;aY4�޷���}��~��9��m�?�q|�&+�8����A��c�-l��yy�	$�9=Xq�/M�aI�1���*u���ĩFx��� �R��[׳��,ㅹu����\Gn�=Y3댜�}���O��%�8cf�W�y |�lu���\����EA�H��S� �`������;k	�(���1�t���y']��"|�%�D翵���uLεM��v�F�Z�����Im,��Cu	�s�P��d��#u�6��������&# ��� #�֘h�&���,.j�52��ݠ�n�@S��<s�
a�II�P�JG@��
v'�{��s��;9:��I�u_|�4-B��aJ~�%�ؓ��c��EU+{��[+�'_��w�����Uy�1��.�h6������Ԛ��m��o���z�z.�S�7
L"�]훮���������A}�I[��_��Ĳ s�{ď�-!Hⶮ�^�n2� �#{P���@+�r�|���<���Rx����4=���K�������W1d���hͽS�Q)њ��S�ş4�3P
tAf2�9!0�aN�݀�7��bd4%p(A>k��ָ`�yǏ ���9|٤�F������o����Q��fR�%��"�{[���Q��ͪ���~��~�y�2SʢІ�p�yPd|n�3�o�>��>�7���?t���P��11�,+�Q6��x|'�$_�/��nĆD#칚Ý��^,��	�7N��5"h��x�c��VR&>E�{lrװ@�$hs�t$�?��E�8�2�E��(��pm�S��Ko��k䉊@ު|��y��8>����.!bSǝ�2����#�$#�����w�-�2}��Ҧ6~��M?�'r��N���a�N�<�G�o�Ʋ�/U=���J_�N�a;��r�eDm�sK��Yj����C�Bbr�R_�u�XoIG�3�~�9��|�3�r_#!��{��+{�pէ�*j�X?l�o~�|`(w� |��!9:u�!��L�+-��y뛫1�8s�����
.�l�T�bw曪��l�54*����;)�c�;�o�"�e�V%���j��<m���j�v0�I�p�F�c���:L@��p�L҇�	���FMIs|��~�n�z�p,l�is7ϔF���,[�
���}��Lpj����U��"�?Vq;��I�1x}ބ����*!7���a{|����r��x/�YH���g�(8�wq�����SO���M=}$��ʣ��1|�.��@��Ϫ��iJm������k9xInRS�#�o�q���m��s���喊�j��Z:f��h�-�&��� ��N���מg��_g{��_Ӗ#y_��{�����ث63��� ����G}���9$��32
�/�d,G�`F������H�#�1��p�A��I�<��8��16�j�<y��1o.����fs��3���/+�hY�M@ay��縸j��mRRؘU^��F��j<~A����H�A7 �1��؁�p5��=_�b�kJ����0���r����٬�|�{�Lg��������y�&�	�Q�7�CPn�4��8��N��ZL�TB�]K�Z,�Κɦ/�	�"�KM��]�_�m��(�(�GIܧ�#I�%����anoL]2���،��X���,�̕�	wZ͕it>5�@%碒�GF�F ZJ�D�e�t�ʭ��@3�����ČǶݖ��}�����ٚ�F_^1U�2�ú�~e<"�/4q椷��RR��L�!L�m��/�G�����_��"\�֟�[�e ��W����<f��0+�6����IQ�Op�]d[�N+�hb*Mv��~:'SaPD��cf����8���09��I,dw�'�y7)��p�H.�,
G�B��0X��y�b�3�s���i����S�<Wޢ+�A«��)�?�}&ȩ�����zڊ^c���Ӕ��o���AWƲ�J$�ط2�����_V���<_S�*iu���愼����ń�E*���(��f�Ҿ�Z���zY�O���Oa���$*��� @�WU�!���g���8%�>�C����S�RU�]���0P��z攜N�쨝��k5���q}N�ʻ�7|�fk��:�:��w~BLFBc
��	�9�e�iw���ߙ����dtx���#��[W�nj�I�$v����5
er97J (3�[5�����v���u�D����;�:rT�u��ih|5#ӯ�Vrd�2�̘ږo�)�ک����A�o����HT����ٵ/^�8ac1�@�p���6��!�y�M$l�M!լ%o~G�p0��z]I6���h1QQx�5f�[؎��S��	jD��&�E~N��Rnå�y�����i�e�&e�	\�hr��w;5�ZCh�+�Uo�?�c�o��r��S��6�,Q��^S�ߨU(�Hd�ߞh�٭ ��#C��%�L���!���c���t7�[$8���b���oD��v�����~
!s���jj ��g�a��
�v��^�(��ϓ�{\�����u�w����:�	�Ѐ�[O0� ���_��6=����*)��ڌ&���m�E�4��h�?��,����l�&B;R�À���BW��#�s: x6�\hXjG'L,�}���ۦ�N�D�}���4�����`�V9P���fè�ߝ�p
 �W
��L=b�T�p�a����0"�`;�*j?�*��2�j��KC~<	00�X������\��:؁2u޽�(*c#�T<�����O�Z�uH���,�z*�7@�^�i����lb0�\��G�Ȑ�ltq�t�G�萀[ܵ��Y��A� yv���'�ڇ<Â�8WH��9����Π!�R,�h�kf����c�nn�Ձ���䐾�c�iXG@%�e�Gh�o��4���8���6L��*T��wR�8�K?�@�M�%��k} u����Fx�3�D^�����͸�K��↏�u,_��3�_!9�=xg'$SZ��Z0���sK?�)5U&0�r��:.M�ɝ*Q�4Ռ�^���׉i��J�E��r���5�3֖����=lxn�񽀷��4�.�j�Mh#fQ4k�8��e� ̖����Gvıo�q�Uʅ�o�P�D{!R���Ǽ��Ӎ�E�C���dn��It���$�M�i߂=�;	�?�� �DP9k-,�J�:m�������κڻ�J��t��vźD�V���:��>Zp�O���X8�;5X��N��eS��t~;>��:�jKBA`j����@u�@_-:� �hoI�������_E�Q�=8���T&7+����H�А1G�nO�2sCj�]{�p�ŵ��$︢�)	~��V��Km�����Y��'�y�!1���'�vU��^�>�y�-(���lP�8(8���K��^��ol�������Y9��IY�c�ft(�zu/���>�V󺶊�	cjr� ����M�Zk	���V�q�8�$��B���z�#/%��^2)�t߸��ܖr��6n����~f�$��s����
�hFy�qϿ���6�tc�7J��oڡ1�#�
��<�U�������'Ұ ��f���N���\�NQ���Gۉƚ��=�0{H�!�0&W�&�&�ս"�QǤsQ�xn�p�꿂OZ7�Y�=[�Ǹ{U0��4�؛��>Ɩ./a���w=���V'�j�����%�����1f�]��I��QAb����I��&�������J��j��-���]�Ĉ������F�H�%҂�w��D��X�K'b�5��/��*̒�� �@f<4��1p��I�v�Aqkɪ�7�]*�Et%@�]�[q�nZeQ���1���Sn令���E�d����߰&ld��柍�`}X�5�^L�[ �������y�2���9�ךi[�/WR-�>!-��~��U��K���h��)�J�A�ƀ;�},%ּ/�	yN�S����_Z7x�Ƭd��f����NH:b-r�S��'�e��r�B���c�k�`ؖ �,6-�k�o��-�,�~��V�`�r�������Hq�c��ϵ�/��P J�Đ�Q�� �S6#�m��x�I�&Û�\<P�ߔ�	[;�>t�i��q��&��=������r5͸�ٔ�J2j�+I���w�����1 u�ѻ�O���.
���K5肌F��[�<,���V��x&��R���d[&T h���W�: �'�l||�MH*4�{�+�G˔X��cV4@oU�=yY��]hf+*�R�̬g��M|�>�bt���x84�r��Tl�
�c9�SͲ�/a=U9}7 �� �v+��?��'�/�Ε�bGd;OlB3���z㷺0Q�;)�d�۝4��S�ɶ-t��S"p�Vx@��J�t�X����M	5?�&�;��rX]��R��c�Ky��d�;���n��SE���F�R�Yk�3���3m����C�l��A 6[y=�� � ���x�2�?��O=��-u{�(:�1X/�YѪͽ����Fu{��h���Yӫba�-�-��v�=�ĳO��EG2���ߠ����� }ߢo��C�W�N�Mq�FŤ�\���Ax����'�!*�$����n�+�0���k壄>v�M
ꚓ@����R$�	<�p�(Z�=5��i�0[cx˖���;��7�x{�w�ڢ�E�`!M�\��M���d�����*����Ph:*���9!�Z��Z��s�W�c���+���0�]8����N7�;���N�#���I�r�6�����~sV�ScYEC2]&���oF�4	�U.��Nrp��śь��1�VA"[�2����1CΒ��a�bXyӘ�۶�0-��6�#*�(��q1Kl6� W�L��T�}�=[��$U�i���8�@�w��ѱVJ��hJ����SW�Wْ�z�E���`���V�����eJF4���t:�c�<D�Y�1-W�L���ńC��y�R��ڐS��i�mx��5�@�Q� ��9LW)�ҫzc��2@s���j���v���J=�zF�3�?����:�u� ���s����8Ŀ���FC@���v�ث�.9~e���Ǧ��\�C��oo;
���(��Z�凪��$e�꼜�l`p��~{:���ۅ�S�7_����8�B}lJ�1P�j VhͷÃw3��n �*�T�1���F'�'���Ԗ�*�y�[���F��"*�r�7g��'�����O\�G�m����j"J���/I�̓ u�B�q���S���5�v��g�g?�ĵ��qe5����w-���;BR�y�Л&����j��Hy\	w�˩��z�`a�/�s�Z�]��Wu�9��c޻z0ȯ�7���� Q"	O�k�qT���\%�2���nm׮�|�Mk\��|��g�=T�C-���3B������S������7�OP��o�Vx'$��V733�ofЮ��ojS�]�;�(�w����63�%�+��Q��MW:㐯��?-v}��N���y.�*�,b�ܨ��\JA$��@t��p�AN�����Ҥ�c�"���&(�>	����q�A��aԟq�h(΋������xbF�!M��x�89��h���kC��oPN���������w�Ԥa,������[ٶai87���G�JTu�:��0��Q�NF�����"�ǻ���ζ꓉�E�F=�WC	��g��+~"��{Jۜ�uH�MV8��U��X�(>\
����z}g�|�ك1�a��Y�񩶬�)��<iED�ge�gb��f�Q�˟��Կ�PZ�p5��A(�l�D��5=���������P��lgC��Y�,bX#g_-9]�748����>��oob$�[��!��3`�-[�-9���K<� �7o`�L�-�7�"�R���Q�O���y��aC��}��/l۸�fa�cA��ޜB�o��B[�j���5�����˛w/�.X���?�V8���."�%Ӛ�Y�A�aj�klO�� �3+�N,��?Cj�~��09d���h���8�ږY��5���N�D>�O�%�635��Ƞ��|짻�5�Gh�'|i�Li�}��Z��n���"���(�K�Iu��3e�F}�@�pa^.�Ie������t<GXh�_�Hj�J�[�LAl� �-��fw�z!+�!�g;#m^�,P�*U��T'p,i�h>�����Ha[����o�d*�h�X�ZcЄ�*�j�okj/�!����f� �c����d[N:���^y�j{��I��������W"��������e� ޵꫁N�����}��OW�!��]\$9G0�٣L���,c�hˈ,���%,�_YF0�Oy�$�D����	�40;?�Um��B�����
�;e-h��H�;Ziߍ=�Z�����Ǖ�Vj�.� 
�gs*BF؇��8�E�����g߶_9���O�찗�����/-� �ít��ͰI?ܝ\淡�#x��&涘dHأ�SL�`S�X�-�B���-'s����|��y{�a�CF�U�O�ٞ0����Q}ypp�kH��e'��K=��.�,�x�f�o��p��n�B+�evw�h�,��:F�3����.�c1p)�#<�=�ϲ9$��e*��7J�����-N����D+����w4��F���KP멧�U��+�!�]u��`�j���]n��~�	T3�Y���ۼ�0�eI;*�	��`�[�.��Ѿx(�[�n�t�2���@�-nVE�p�(�_�{�N�>�e�pSݡ��҆(n���{z�PQ�j��p$�~��'�"*k{�b��J�Ҭ;:W�v|*�G8�t�����g�V�^���� �C���ݳ!u`
���Vs�灌�k35Oi�R'M�z�;j��p��ʞ+�'����=9aڟ��Z��ݠ�����@E���R�%H���>�[�.�e�-ھ4�щ�E����̧,Ķ�$:��)`�9N,	*��i�L�����K��/�ry[��qKn�U��U{%8�E@*M��#�[<�I7�l*2L�kPe[^j3�ˡ�Fм�Ɓ:�n=�I������ϵB	ip���t���u�����R�/�O��]�\Oy�`����+��P��ˡ�Ab�Gy��WM	5uk����5p�P�U��1����oom��2�\%r�"�x������pO�_�s{��׌˭���Y3�����U�&�{���#�'�ͦ0��~_��̿����$��}���h���T�����i1-��^���QA[�WX�u4� �H)T#�j�[�a)Ma���DL�{����P�|ppi���v.���C�j�?'���"���ˀN���SZU���f����i
�4�������4��] Z/W���o�|	��39(V36�$.�{� Em��	�Q���#���s��vW����B��BW�O=� |���4.��b�Ρ ɬ�K�M���j�/�4�Ao��=��RI�cc���7�3/y�2�A�5���r����&�{=k
��2�1���m�ԋOש0hUTsNk0j^��Pr��:eq�����Y<��-j��)���NM�[p��"�~���ҧ��$;~�������p�����~�n�|7ӦsF��#&(`�kS�d@�7�jr�w쒻��]��ۦu�ӃIw�l�s;`�"/��ٳ������ت�����4̊L���$CZ�V)'��}�m�6�|��[֐�Ϸ v��v�(32>����CO�G����yk+G�|e��]	2�ƾ�9��j��
ݫS�}��i�
�T'��o5.<��#yi��tԒ���_c�|:�ڷ�-�u�Ez.����U?K��p�������n 	�#RO�����b��DA*��U��g�5yt�Ch��]A/�t�$��=����#ޏ`d&�)Lr�bG�mtRk��F����԰GQ�oC[%�|5F�^�Jb��}2i��PP�p!��� hWg�{��w�(��4���p�ݼ#վ�WPS�qV����<�o�Ȑ�T̽�X������R�$bT�h���*Q��$��ׅ�i��I=��J6g���C��C]��ѽ���w7gխ�?�������w��Z����j]���_��t쟈Ӄ^+��'���N7����,(�׷������+*�-��czz܅3C�i(�٭����SQG�ӾW�F4�a�����PCfM >u��(�D%Ô���d� ͹p� ��C��P�}#�MR�X؊�O�ێ����=��ع�^�It��ޣ���ͧ�+�WL|��k�gB��Hl�"�r"\	�ļ�hU>TÞȞL?��za�՚b����ş��uǼ�,�:Ӈ	�PO�I��ph����%/]R�L�i_Z��
�T���-46���Y=I��`�<��(� 	!l�sF�c��%�;WH�ŕ�=��zv��	Q�d�F,?9<��p}xT�lАxc�i�t*$��:�}#��74����W��|����2�^��T�?ɤ�	�/��ʄ�!Y9B{�8ɿ�vK�,H���_����u#��뒅��I���OP�̆���Yj08y����F���K�#�UL%"�\��aJ9�����8{$n45��5�')�u��e:e�Ȯ���W@7�����5t8�|�_�U�3�h�'�>�N��w�3UT�k����j�ÇW[�����S�}�s������R��wy�M�X-~~N���LZA�ckq�����!I�Z֦���l��������BM�of�X1G��G	0�§a��t:�g�hJ?ٷa�ؽ��)�[��pmݯ
\�Θ ߜ���#}~)*��f��hq-�_�l�cnl��Q07��%:y6�@�rB�G�ɑ��ApY���i~��Z�����
n:0��lA�{A�z�p6��E�����f� N���]g"��L�0�l}?�^�v��'�B_��ʂ"�����*D���S�������5� P[H�n E¥S%��Ĳd���2a.�&D�P�y
ި ���ɢ�1hthS�-�v�ޗ]�t�.9��:w�؏[� �CdQ�N]8��s-}������+����$oG Ƶ�w�����B�/$�k�#��6m�t7 x��o��Ʃ %�P �$I� ��7[P(��r�$�Ώ��	��J{���j)_��:	V���h���4�I���c�<��h�˷���2>q���ߊ��z�pdYf���D�vSJ�i3��GW�P~��8g ~��l��@d�8kJM#�v!h��jjw���/|�~��x�>����N@��`��zl�K���$`�h����?:��U�Ͷu2�5� 	�6Z�K�D+H�&Ws7�����X��z%ğ����?D
�K�U,��j���t��!����({	O�Q��
AO����İc��h� ���Nm�:W�����1�څO�u**=��#l��ӛ��p���8��V��]|��n{��j.�G��wYI�4��
�������=;��4QW[�8�G?5(�u-"��;�5��($r���ܓ��ʍV�[�i��݉��;n�w��+� ?ʍcl�&H?���G��ζK��$- ����!��-�� �v[a4 h_�5q�1�2�