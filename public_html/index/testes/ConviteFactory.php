<?php

class ConviteFactory {
    public function criaConvite() {
        Convite::$convite = new Convite;
        return $convite;
    }
}
