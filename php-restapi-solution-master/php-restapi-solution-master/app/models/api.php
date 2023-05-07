<?php

class Api
{

    private int $apiID;
    private string $apiName;
    private string $apiKey;

    public function __construct(int $apiID = 0, string $apiName = '', string $apiKey = '')
    {
        $this->apiID = $apiID;
        $this->apiName = $apiName;
        $this->apiKey = $apiKey;
    }    

	/**
	 * @return 
	 */
	public function getApiID(): int {
		return $this->apiID;
	}
	
	/**
	 * @param  $apiID 
	 * @return self
	 */
	public function setApiID(int $apiID): self {
		$this->apiID = $apiID;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getApiName(): string {
		return $this->apiName;
	}
	
	/**
	 * @param  $apiName 
	 * @return self
	 */
	public function setApiName(string $apiName): self {
		$this->apiName = $apiName;
		return $this;
	}

	/**
	 * @return 
	 */
	public function getApiKey(): string {
		return $this->apiKey;
	}
	
	/**
	 * @param  $apiKey 
	 * @return self
	 */
	public function setApiKey(string $apiKey): self {
		$this->apiKey = $apiKey;
		return $this;
	}
}
