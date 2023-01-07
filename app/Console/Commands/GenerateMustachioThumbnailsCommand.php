<?php

namespace App\Console\Commands;

use App\Mustachio;
use Illuminate\Console\Command;
use Symfony\Component\Console\Output\ConsoleOutput;

class GenerateMustachioThumbnailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ownly:generate_mustachio_thumbnails_command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $out = new ConsoleOutput();


























































        $thumbnails = ["kzvmblfdiygkgtevlglc",
            "ovryvdevfdjozztgifem",
            "wwifqquphyiocmvvcovw",
            "kloctpcyemfqtnogeowv",
            "pdzgodvrfrhypfkejewg",
            "lohaeildygarbeywouxr",
            "yecashzlglbonxekptmq",
            "ncehmhrlbwcelgutfcop",
            "thvsrmliegvvzdqlhmfl",
            "olfntinfewcegncvryfk",
            "emildfiawxxqwhwwdmnk",
            "veujjbkwdofguevlrrnq",
            "bxkgakdkwblemfcbtrru",
            "biajorxlngdcchpzkslz",
            "dpqfucqdjwmavakxshjr",
            "yaojpxvwiexxzilbialj",
            "fokrucmisbjiczsrgtgz",
            "tzbrnimslrphvvxrkpam",
            "wztyjmrrcbunxqmrzgqs",
            "xucxbkstbhtbfhrodzdd",
            "wsxsqpppmgjeqbxfcnbk",
            "ctwfddmlngodkvzfvnoa",
            "bbbdgjrzssrlzgbzwvof",
            "rlojauupnaxlxrtyfska",
            "nkwwxzrpjnlnpxkimxia",
            "pakemkbanubdcxoumuve",
            "dntdnrzhqjauogfqbdnz",
            "qjqflbqzfbtzzplzldsy",
            "yqhpctazifdrgtxaanbu",
            "ttgcrajqbypfsjgczuzo",
            "itjnpdgdcnuittxlbkhh",
            "gmlgkvjunjwapcgjvaub",
            "aauttsnfhhmjtnzfuwwc",
            "gizhjxsrmrgzbothkggq",
            "jownhqytshzdnwugqysb",
            "dhuawymvntvareswgcmw",
            "ftwebdyikbtvhoxhvakh",
            "lhbycbmqvismgpprcfik",
            "mwzehqilarbgkbuvulmx",
            "lwjuhgvneirjyalqsfrj",
            "lkgdhnlhwuxpdvewnppq",
            "gaipkeirjuyflkebgwqs",
            "jopvucdhxxdjgafirsnv",
            "elxocmesentkmmvskhlb",
            "vlrgmofmsnhcmoocrtbu",
            "tqtecexswbuxspdpocnz",
            "mpeztguwveazokkhupyr",
            "vlonoigilkikwdkgjeuk",
            "kjtvhtswcrvovokvdgpq",
            "cqgjvprunnlxrwijkwaj",
            "hbhvbunvjbkdmpxgiqgo",
            "jqqwxnpatengtatrpmfh",
            "mimphtsqylgqxjtbtmwc",
            "yoaueequenrurbvkixkz",
            "xmqrkqbwkzgslcdxrjke",
            "daztuckbaktkgfzbimob",
            "kmaysxzpgbduqxxacfwu",
            "gblwckwoajlmwtjcsczk",
            "finoyktnpdnevjfupret",
            "ilizombonbhdfhxrldda",
            "ertaxudacndoracqcole",
            "xgjptdbuakqequgtdgdu",
            "swgwkjevccrhrticioeh",
            "tuzeesjsdviivmdkxcyr",
            "hoarcejdhfyadqhpfsko",
            "ogznsxzvdhsrlttxibzy",
            "sbzqxhjwdwzcdhbnkqzb",
            "wghbzpcwjjbhgiailrnf",
            "tlnwqkyrqujrlwaestdr",
            "xrebplzciltsfcgpauve",
            "amlxiemhhatktfzvnkhv",
            "uiozqxeytfpmyahsfhpm",
            "vyojdjdsdjnkqejkguky",
            "csbflggykznwtgrwoeez",
            "mxrlyoutpcryvzczlnpw",
            "aayftpalmlgrpeibvaad",
            "pulrbsfmuucvbfwycxwl",
            "fsnlmxoukycwbxccjdne",
            "yumkppemdjybnaawqigq",
            "ftdnpbkxicrkvlsilwoa",
            "htkaigkrtyvndbkkpydh",
            "sdxvpwgoperkgzzoxgru",
            "uqlqiecagbfilqogqbso",
            "gsbdpmoacphkiurchqcl",
            "nbqfzszrlmolxsogdjho",
            "olytyeqkwaxlkmtkrhms",
            "judbcxlzrxeaswhzictn",
            "nlidwjanxkiymeagppuv",
            "yfouvhrsftibzsuimqcg",
            "tddvmynbtlwdimrxgsrs",
            "hrivolqtltxuhexhtfma",
            "myetagsgspljsbdlfwac",
            "rlpukzkgvtqwbzrwnvja",
            "ontjsfkgzqdgklqdykad",
            "tjisbfpolucmrvvnfhlt",
            "cdlnvmnuyhpybfguniwe",
            "lylktoxhufzehouppfiu",
            "apxewfcrbixkgltiadkn",
            "shqeabdbocjzrttbtbpa",
            "bntgnpgibqsuwltblumw"];

        foreach($thumbnails as $i => $thumbnail) {
            $out->writeln('Generating Token ' . ($i + 1) . ' - ' . $thumbnail . '.webp');

            $mustachio = Mustachio::find($i + 1);

            $mustachio->thumbnail = 'https://ownly.market/nft/the-mustachios/webp/' . $thumbnail . '.webp';
            $mustachio->update();
        }

        return 0;
    }
}
